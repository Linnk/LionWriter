<?php

class LionWriterView
{
	private $__hasRendered = false;
	private $__layout;
	private $__view;
	private $__data = array();
	
	public function __construct($view = 'default', $layout = 'default')
	{
		$this->__view = $view;
		$this->__layout = $layout;
	}
	protected function _hasRendered()
	{
		return $this->__hasRendered ? true : false;
	}
	protected function _startRender()
	{
		$this->__hasRendered = true;
	}
	protected function _getFilenameForView()
	{
		return LION_SITE.DS.'views'.DS.$this->__view.'.php';
	}
	protected function _getFilenameForLayout()
	{
		return LION_SITE.DS.'layouts'.DS.$this->__layout.'.php';
	}
	protected function _hasLayout()
	{
		return ($this->__layout === null || $this->__layout === false) ? false : true;
	}
	public function set($key, $value)
	{
		if($this->_hasRendered())
			trigger_error('LionWriterView is currently renderizing, you can\'t modify the data.', E_USER_ERROR);

		$this->__data[$key] = $value;
	}
	public function get()
	{
		return $this->__data;
	}
	public function renderError404()
	{
		header('HTTP/1.0 404 Not Found');
		
		if(file_exists(LION_SITE.DS.'errors'.DS.'error404.php'))
		{
			$this->__view = '..'.DS.'errors'.DS.'error404';
			$this->render();
		}
		else
		{
			echo "<h3>Not Found</h3><p>The requested URL {$_SERVER["REQUEST_URI"]} was not found on this server.</p><hr>";
		}
	}
	public function renderMissingView()
	{
		header('HTTP/1.0 404 Not Found');
		
		exit("<h3>Missing view</h3><p>The view “{$this->__view}.php” did not exists. Create the file Site/views/{$this->__view}.php to fix this error.</p><hr>");
	}
	public function renderMissingLayout()
	{
		header('HTTP/1.0 404 Not Found');
		
		exit("<h3>Missing layout</h3><p>The layout “{$this->__layout}.php” did not exists. Create the file Site/layouts/{$this->__layout}.php to fix this error.</p><hr>");
	}
}

