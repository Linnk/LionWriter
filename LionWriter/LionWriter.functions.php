<?php


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
function substract_summary($content, $lenght)
{
	if(strlen($content) <= $lenght)
		return content;
	
	$content = substr($content, 0, $lenght);
	
	if(($whitespace_position = strrpos($content, ' ')) !== false)
		$content = substr($content, 0, $whitespace_position);

	return $content;
}