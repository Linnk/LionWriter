<?php

error_reporting(E_ALL);

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

	private function __construct() { }


	public static function loadView()
	{
		return false;
	}
	public static function loadError404()
	{
		return false;
	}
	public static function queryForDynamicContent()
	{
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
		
		if(in_array(self::$__path, self::$__static_routes))
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
		pr(self::$__static_routes);
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