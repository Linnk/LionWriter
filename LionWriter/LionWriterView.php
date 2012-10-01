<?php

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
