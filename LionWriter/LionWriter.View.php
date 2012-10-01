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
	public function set($key, $value)
	{
		if($this->__hasRendered === true)
			trigger_error('LionWriterView is currently renderizing, you can\'t modify the data.', E_USER_ERROR);

		$this->__data[$key] = $value;
	}
	private function renderLayout($content_for_layout)
	{
		extract($this->__data);
		require(LION_SITE.DS.'layouts'.DS.$this->__layout.'.php');
	}
	public function render()
	{
		if($this->__hasRendered === true)
			trigger_error('LionWriterView is currently renderizing, you can\'t call render twice.', E_USER_ERROR);
		
		$this->__hasRendered = true;

		ob_start();
		extract($this->__data);
		require(LION_SITE.DS.'views'.DS.$this->__view.'.php');

		$content_for_layout = ob_get_contents();
		ob_end_clean();

		$this->renderLayout($content_for_layout);
	}
	public function element($element)
	{
		ob_start();
		extract($this->__data);
		require(LION_SITE.DS.'elements'.DS.$element.'.php');
		
		$element_output = ob_get_contents();
		ob_end_clean();

		return $element_output;
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
			exit("<h1>Not Found</h1><p>The requested URL " . $_SERVER["REQUEST_URI"] . " was not found on this server.</p><hr>");
		}
	}
}

