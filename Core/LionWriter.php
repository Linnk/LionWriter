<?php

error_reporting(E_ALL);

require(LION_CORE.DS.'vendors'.DS.'markdown.php');

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
	public static $formats = '/^[A-Za-z0-9\.-]+(\.md|\.txt|\.html)/i';

	private function __construct() { }

	public static function loadPage($filename)
	{
		$page = array();
		$content = file_get_contents($filename);
		
		$lines = explode("\n", $content);
		foreach($lines as $index => $line)
		{
			if(strpos($line,':')===false) // change for preg_match
				break;

			list($key, $value) = explode(':', $line);

			$page[trim($key)] = trim($value);
			unset($lines[$index]);
		}
		if(!isset($page['title']))
			$page['title'] = 'Unknow title';
		if(!isset($page['author']))
			$page['author'] = 'Unknow author';

		$content = trim(implode("\n", $lines));

		$file = str_replace(dirname($filename).DS, '', $filename);
		preg_match(self::$formats, $file, $matches);
		
		if($matches[1]=='.md')
		{
			$page['content'] = Markdown($content);
		}
		elseif($matches[1]=='.txt')
		{
			$lines = explode("\n", $content);
			foreach($lines as $index => $line)
				$lines[$index] = '<p>'.$line.'</p>';
			$page['content'] = implode("\n", $lines);
		}
		else
			$page['content'] = $content;

		return $page;
	}
	public static function loadView($route)
	{
		echo 'loadView';
		pr($route);
		$foldername = LION_CONTENT.DS.$route['content'];
		
		$View = new LionWriterView($route['view'], $route['layout']);

		if(is_dir($foldername))
		{
			$files = array();
		    $dir = dir($foldername);
			while(false !== ($file = $dir->read()))
			{
				if($file==='.' || $file==='..' || !preg_match(self::$formats, $file))
					continue;

				$files[] = $file;
			}
			$dir->close();

			arsort($files);

			$pages = array();
			foreach($files as $n => $file)
			{
				if(isset($route['limit']) && $route['limit'] >= $n)
					break;

				$pages[] = self::loadPage($foldername.$file);
			}

			$View->set('pages', $pages);
			$View->render();
		}
		elseif(file_exists($filename = $foldername.'.md'))
		{
			$page = self::loadPage($filename);
			
			$View->set('page', $page);
			$View->render();
		}
		else
		{
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
		echo 'queryForDynamicContent';
		return false;
	}
	public static function queryForStaticContent()
	{
		echo 'queryForStaticContent';
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
		
		pr(self::$__path);
		pr(self::$__static_routes);

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
		pr(self::$__dynamic_routes);
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

class LionWriterView
{
	private $__rendering = false;
	private $__layout = 'default';
	private $__view = 'default';
	private $__data = array();
	
	public function __construct($view, $layout)
	{
		$this->__view = $view;
		$this->__layout = $layout;
	}
	public function set($key, $value)
	{
		$this->__data[$key] = $value;
	}
	public function render()
	{
		echo '<hr />View rendered!';
		pr($this->__data);
		echo ' <hr />';
	}
	public function element($view)
	{
	}
	public function renderError404()
	{
		//header('HTTP/1.0 404 Not Found');
		echo 'error 404';
	}
	public function renderError403()
	{
		//header('HTTP/1.0 403 Forbbiden');
		echo 'error 403';
	}
}

if(!function_exists('pr'))
{
	function pr($mixed)
	{
		echo '<pre>'.print_r($mixed, true).'</pre>';
	}
}
if(!function_exists('vd'))
{
	function vd($mixed)
	{
		echo '<pre>';
		var_dump($mixed);
		echo '</pre>';
	}
}