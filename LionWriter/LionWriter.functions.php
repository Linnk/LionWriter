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
function substract_summary($content, $lenght, $p = false)
{
	if(strlen($content) <= $lenght)
		return content;
	
	$content = substr($content, 0, $lenght);
	
	if(($whitespace_position = strrpos($content, ' ')) !== false)
		$content = substr($content, 0, $whitespace_position);

	if($p)
	{
		$lines = explode("\n", $content);

		foreach($lines as $index => $line)
			$lines[$index] = '<p>'.$line.'</p>';

		$content = implode("\n", $lines);
	}

	return $content;
}