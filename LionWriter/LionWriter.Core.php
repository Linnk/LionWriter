<?php

class LionWriter
{
	private static $__path;
	private static $__static_routes;
	private static $__dynamic_routes;
	private static $__default_options = array(
		'content' => null,
		'view' => 'default',
		'layout' => 'default',
	);
	public static $formats = array(
		'.md' => 'Markdown',
		'.txt' => 'Regular text',
		'.html' => 'HTML',
	);
	public static $formats_pattern = '/^[A-Za-z0-9\.\-_]+(\.md|\.txt|\.html)/i';
	public static $key_value_pattern = '/^([A-Za-z0-9\.\-_]+):(.*)/i';

	private function __construct() { }

	public static function loadPage($filename, $format = 'HTML')
	{
		$page = array();
		$content = file_get_contents($filename);
		
		$lines = explode("\n", $content);
		foreach($lines as $index => $line)
		{
			if(!preg_match(self::$key_value_pattern, $line, $matches))
				break;

			$page[$matches[1]] = trim($matches[2]);
			unset($lines[$index]);
		}

		if(!isset($page['title']))
			$page['title'] = 'Unknow title';

		if(!isset($page['author']))
			$page['author'] = 'Unknow author';

		$content = trim(implode("\n", $lines));

		switch($format)
		{
			case 'Markdown':
				$page['content'] = Markdown($content);
				break;

			case 'Regular text':
				$lines = explode("\n", $content);
				foreach($lines as $index => $line)
					$lines[$index] = '<p>'.$line.'</p>';
				$page['content'] = implode("\n", $lines);
				break;

			default: // HTML
				$page['content'] = $content;
				break;
		}
		return $page;
	}
	public static function loadView($route)
	{
		$foldername = LION_CONTENT.DS.$route['content'];

		$View = new LionWriterView($route['view'], $route['layout']);

		if(is_dir($foldername))
		{
			$files = array();
		    $dir = dir($foldername);
			while(false !== ($file = $dir->read()))
			{
				if($file==='.' || $file==='..' || !preg_match(self::$formats_pattern, $file))
					continue;

				$files[] = $file;
			}
			$dir->close();

			arsort($files);
			
			if(!isset($route['limit']) || !is_numeric($route['limit']))
				$route['limit'] = false;

			$n = 0;
			$pages = array();
			foreach($files as $file)
			{
				if(is_numeric($route['limit']) && $n >= $route['limit'])
					break;
				
				preg_match(self::$formats_pattern, $file, $matches);

				$pages[] = self::loadPage($foldername.$file, self::$formats[$matches[1]]);
				$n++;
			}

			$View->set('pages', $pages);
			$View->render();
		}
		else
		{
			if(file_exists($foldername))
			{
				$components = explode(DS, $foldername);
				preg_match(self::$formats_pattern, $components[count($components)-1], $matches);

				$page = self::loadPage($foldername, self::$formats[$matches[1]]);
			}
			else
			{
				foreach(self::$formats as $ext => $format)
				{
					if(file_exists($filename = $foldername.$ext))
					{
						$page = self::loadPage($filename, $format);
						break;
					}
				}
			}

			if(isset($page))
			{
				$View->set('page', $page);
				$View->render();
			}			
			else
				$View->renderError404();
		}

		return false;
	}
	public static function loadError404()
	{
		echo 'error 404';
		return false;
	}
	public static function queryForDynamicContent()
	{
		$parameters = explode('/', self::$__path);
		
		$default_variables = array(
			':Y' => '\d{4}',
			':m' => '\d{2}',
			':d' => '\d{2}',
			':title' => '[A-Za-z0-9\.\-_]+',
		);
		
		$filename_pattern = '/^(:Y)-(:m)-(:d)\-(:title)(\.md|\.txt|\.html)/i';

		foreach(self::$__dynamic_routes as $pattern => $route)
		{
			$query_variables = explode('/', $pattern);
			
			$variables = $default_variables;

			foreach($query_variables as $index => $variable)
			{
				if(isset($variables[$variable]) && isset($parameters[$index]))
					$variables[$variable] = $parameters[$index];
			}
			$query = str_replace(array_keys($variables), $variables, $filename_pattern);

			$foldername = LION_CONTENT.DS.$route['content'];

			if(is_dir($foldername))
			{
				$located = false;
			    
			    $dir = dir($foldername);
				while(false !== ($file = $dir->read()))
				{
					if($file==='.' || $file==='..' || !preg_match($query, $file))
						continue;
					
					$located = true;
					break;
				}
				$dir->close();

				if($located)
				{
					$route['content'] = $route['content'].$file;
					return $route;
				}
			}
		}

		return false;
	}
	public static function queryForStaticContent()
	{
		$content = substr(self::$__path, 1);
		$filename = LION_CONTENT.DS.$content.'.md';

		if(file_exists($filename))
			return array('content' => $content) + self::$__default_options;

		return false;
	}
	public static function dispatch()
	{
		require(LION_SITE.DS.'configuration.php');

		self::$__path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
		
		if(isset(self::$__static_routes[self::$__path]))
		{
			self::loadView(self::$__static_routes[self::$__path]);
		}
		elseif($dynamic_route = self::queryForDynamicContent())
		{
			self::loadView($dynamic_route);
		}
		elseif($static_route = self::queryForStaticContent())
		{
			self::loadView($static_route);
		}
		else
		{
			self::loadError404();
		}
	}
	public static function route($path, $options = array())
	{
		$options = $options + self::$__default_options;
		$options['path'] = $path;
		
		if($options['content'] == null)
			$options['content'] = substr($path, 1).'.md';

		if(strstr($path,':'))
			self::$__dynamic_routes[$path] = $options;
		else
			self::$__static_routes[$path] = $options;
	}
}
