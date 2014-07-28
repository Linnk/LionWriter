<?php

require(LION_CORE.DS.'LionWriter.View.php');

class LionWriterTheme extends LionWriterView
{
	public function getContent($page_name, $format = 'Markdown')
	{
		$page = $this->getPage($page_name);
		return $page['content'];
	}
	public function getPage($page_name, $format = 'Markdown')
	{
		return LionWriter::loadPage(LION_CONTENT.DS.$page_name, $format);
	}
	public function render()
	{
		if($this->_hasRendered())
			trigger_error('LionWriterView is currently renderizing, you can\'t call render twice.', E_USER_ERROR);
		
		$this->_startRender();

		if(!file_exists($this->_getFilenameForView()))
			$this->renderMissingView();

		extract($this->get());

		if($this->_hasLayout())
		{
			ob_start();
			require($this->_getFilenameForView());
		
			$content_for_layout = ob_get_contents();
			ob_end_clean();
			
			if(!file_exists($this->_getFilenameForLayout()))
				$this->renderMissingLayout();
	
			extract($this->get());
			require($this->_getFilenameForLayout());
		}
		else
			require($this->_getFilenameForView());
	}
	public function element($element)
	{
		if(!file_exists(LION_SITE.DS.'elements'.DS.$element.'.php'))
			return 'Missing element file: '.$element_filename;
		
		ob_start();
		extract($this->get());
		require(LION_SITE.DS.'elements'.DS.$element.'.php');
		
		$element_output = ob_get_contents();
		ob_end_clean();

		return $element_output;
	}
	public function link($html, $magic_url, $attributes = array())
	{
		$attributes = $attributes + array(
			'href' => $this->URLFromMagicURL($magic_url)
		);

		$attributes_html = $this->htmlFromAttributes($attributes);

		return '<a'.$attributes_html.'>'.$html.'</a>';
	}
	public function css($css_name, $attributes = array())
	{
		$url = $this->URLFromMagicURL(LION_THEME.DS.'css'.DS.$css_name.'.css');
		
		$attributes = $attributes + array(
			'rel' => 'stylesheet',
			'type' => 'text/css',
			'href' => $url
		);

		$attributes_html = $this->htmlFromAttributes($attributes);

		return '<link'.$attributes_html.' /> ';
	}
	public function javascript($js_name, $attributes = array())
	{
		$url = $this->URLFromMagicURL(LION_THEME.DS.'js'.DS.$js_name.'.js');
		
		$attributes = $attributes + array(
			'type' => 'text/javascript',
			'src' => $url
		);

		$attributes_html = $this->htmlFromAttributes($attributes);

		return '<script'.$attributes_html.'></script>';
	}
	public function image($image_filename, $attributes = array())
	{
		$url = $this->URLFromMagicURL(LION_THEME.DS.'img'.DS.$image_filename);
		
		$attributes = $attributes + array(
			'border' => '0',
			'src' => $url
		);

		$attributes_html = $this->htmlFromAttributes($attributes);

		return '<img'.$attributes_html.' />';
	}
	protected function htmlFromAttributes($attributes)
	{
		$html = '';
		foreach($attributes as $attribute => $value)
		{
			$html .= ' '.$attribute.'="'.$value.'"';
		}
		return $html;
	}
	protected function URLFromMagicURL($magic_url)
	{
		if(LION_REWRITE)
		{
			return $magic_url;
		}

		return '/index.php'.$magic_url;
	}
}