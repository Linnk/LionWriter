<?php

class LionWriter
{
	private static $__shouldDispatch = true;
	private static $__theme = null;
	private static $__path;
	private static $__static_routes;
	private static $__dynamic_routes;
	private static $__default_options = array(
		'content' => null,
		'view' => 'page',
		'layout' => 'default',
		'summary' => 500,
	);
	public static $formats = array(
		'.md' => 'Markdown',
		'.txt' => 'Regular text',
		'.html' => 'HTML',
	);
	public static $formats_pattern = '/^[A-Za-z0-9\.\-_]+(\.md|\.txt|\.html)/i';
	public static $key_value_pattern = '/^([A-Za-z0-9\.\-_]+):(.*)/i';
	public static $filename_pattern = '/^(\d{4})-(\d{2})-(\d{2})\-([A-Za-z0-9\.\-_]+)(\.md|\.txt|\.html)/i';
	public static $date_pattern = '/^(\d{4})-(\d{2})-(\d{2})/i';

	private function __construct() { }

	public static function loadPage($filename, $format = 'HTML')
	{
		$page = array();
		$content = file_exists($filename) ? file_get_contents($filename) : '';

		$lines = explode("\n", $content);
		foreach($lines as $index => $line)
		{
			if(!preg_match(self::$key_value_pattern, $line, $matches))
				break;

			$page[$matches[1]] = trim($matches[2]);
			unset($lines[$index]);
		}

		if(!isset($page['title']))
			$page['title'] = 'Unknown title';

		if(!isset($page['author']))
			$page['author'] = 'Unknown author';

		if(isset($page['date']) && preg_match(self::$date_pattern, $page['date'], $matches))
		{
			$page['date'] = date('F',mktime(0,0,0,$matches[2],$matches[3],$matches[1])).' '.$matches[3].', '.$matches[1];
		}
		else
			$page['date'] = 'Unknown date';

		$content = trim(implode("\n", $lines));
		switch($format)
		{
			case 'Markdown':
				require_once(LION_CORE.DS.'vendors'.DS.'parsedown'.DS.'Parsedown.php');
				require_once(LION_CORE.DS.'vendors'.DS.'parsedown'.DS.'ParsedownExtra.php');

				$parsedown = new ParsedownExtra();

				$page['content'] = $parsedown->text($content);
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

		$View = new LionWriterTheme($route['view'], $route['layout']);

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

			if(!isset($route['order']) || strtolower($route['order'])==='desc')
				arsort($files);
			
			if(!isset($route['limit']) || !is_numeric($route['limit']))
				$route['limit'] = false;
			
			foreach(self::$__dynamic_routes as $dynamic_route)
			{
				if($dynamic_route['content']===$route['content'])
					$permalink = $dynamic_route['path'];
			}

			$n = 0;
			$pages = array();
			foreach($files as $file)
			{
				if(is_numeric($route['limit']) && $n >= $route['limit'])
					break;
				
				preg_match(self::$filename_pattern, $file, $matches);

				$page = self::loadPage($foldername.$file, self::$formats[$matches[5]]);
				
				if(isset($permalink))
				{
					unset($matches[0],$matches[5]);
					$page['permalink'] = str_replace(array(':Y',':m',':d',':title'), $matches, $permalink);
				}
				$page['excerpt'] = substract_summary(strip_tags($page['content']), $route['summary']);

				$pages[] = $page;
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
				$page['excerpt'] = substract_summary(strip_tags($page['content']), $route['summary']);

				$View->set('page', $page);
				$View->set('title_for_layout', $page['title']);

				if(isset($page['excerpt']))
					$View->set('description_for_layout', $page['excerpt']);
				if(isset($page['keywords']))
					$View->set('keywords_for_layout', $page['keywords']);

				$View->render();
			}			
			else
				$View->renderError404();
		}

		return false;
	}
	public static function loadError404()
	{
		$View = new LionWriterTheme();
		$View->renderError404();
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
	public static function queryForBinaryFile()
	{
		$filename = LION_CONTENT.DS.substr(self::$__path, 1);

		if(file_exists($filename))
		{
			$name = substr($filename, strrpos($filename, DS) + 1);
			$ext = substr($name, strrpos($name, '.') + 1);
			$options = array(
				'file' => $name,
				'ext' => $ext,
				'path' => $filename,
				'type' => 'mime/type'
			);
			if($ext === 'png')
				$options['type'] = 'image/png';
			elseif($ext === 'jpg' || $ext === 'jpeg')
				$options['type'] = 'image/jpg';
			elseif($ext === 'gif')
				$options['type'] = 'image/gif';
				
			return $options;
		}

		return false;
	}
	public static function prepareForDispatch()
	{
		self::$__path = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
	}
	public static function doNotDispatch()
	{
		self::$__shouldDispatch = false;
	}
	public static function dispatch()
	{
		if(self::$__shouldDispatch === false)
			return;

		if($route = self::get(self::$__path))
		{
			self::loadView($route);
		}
		elseif($route = self::queryForDynamicContent())
		{
			self::loadView($route);
		}
		elseif($route = self::queryForStaticContent())
		{
			self::loadView($route);
		}
		elseif($route = self::queryForBinaryFile())
		{
			self::loadFile($route);
		}
		else
		{
			self::loadError404();
		}
	}
	public static function loadFile($route)
	{
		if($route['type'] === 'image/png')
		{
			$image = imagecreatefrompng($route['path']);
			header('Content-Type: image/png');
			imagepng($image);
			imagedestroy($image);
		}
		elseif($route['type'] === 'image/jpg')
		{
			$image = imagecreatefromjpeg($route['path']);
			header('Content-Type: image/png');
			imagejpeg($image);
			imagedestroy($image);
		}
		elseif($route['type'] === 'image/gif')
		{
			$image = imagecreatefromgif($route['path']);
			header('Content-Type: image/gif');
			imagegif($image);
			imagedestroy($image);
		}
		else
		{
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Disposition: attachment; filename={$route['file']}");
			header("Content-Type: application/octet-stream");
			header("Content-Transfer-Encoding: binary");
			header('Content-Length: ' . filesize($route['path']));
			readfile($route['path']);
		}
		exit;
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
	public static function get($path)
	{
		if(isset(self::$__static_routes[$path]))
		{
			return self::$__static_routes[self::$__path];
		}
		return false;
	}
	public static function setTheme($theme_name)
	{
		if(is_null(self::$__theme) && is_string($theme_name))
			self::$__theme = $theme_name;
	}
	public static function theme()
	{
		return self::$__theme;
	}
}
