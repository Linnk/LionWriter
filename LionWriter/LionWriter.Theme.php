<?php

require(LION_CORE.DS.'LionWriter.View.php');

class LionWriterTheme extends LionWriterView
{
	public function link($html, $magic_url, $attributes = array())
	{
		$attributes_html = $this->htmlFromAttributes($attributes);
		$url = $this->URLFromMagicURL($magic_url);

		return '<a'.$attributes_html.'>'.$html.'</a>';
	}
	public function css($css_name, $attributes = array())
	{
		$url = $this->URLFromMagicURL('/css/'.$css_name.'.css');
		
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
		$url = $this->URLFromMagicURL('/js/'.$js_name.'.js');
		
		$attributes = $attributes + array(
			'type' => 'text/javascript',
			'src' => $url
		);

		$attributes_html = $this->htmlFromAttributes($attributes);

		return '<script'.$attributes_html.'></script>';
	}
	public function image($image_filename, $attributes = array())
	{
		$url = $this->URLFromMagicURL('/img/'.$image_filename);
		
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