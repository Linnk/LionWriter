<?php
/**
 * Useful functions
 *
 * In this files are declared some useful functions used on debugging and
 * also inside de core of LionWriter itself.
 *
 * PHP 5
 *
 * LionWriter : Rapid Development Framework (http://lionwriter.com)
 * Copyright 2012, Juan I. Benavides. (http://juanbenavides.info)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, Juan I. Benavides. (http://juanbenavides.info)
 * @link          http://lionwriter.com LionWriter Project
 * @package       Views
 * @since         LionWriter v 0.1
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Check if the pr functions exists. If not,  declare it. This echoes
 * a $mixed content with print_r inside a <pre> element.
 *
 * @param $mixed
 * @return void
 */
if(!function_exists('pr'))
{
	function pr($mixed)
	{
		echo '<pre>'.print_r($mixed, true).'</pre>';
	}
}
/**
 * Check if the vd functions exists. If not, declare it. This echoes
 * a $mixed content with var_dump inside a <pre> element.
 *
 * @param $mixed
 * @return void
 */
if(!function_exists('vd'))
{
	function vd($mixed)
	{
		echo '<pre>';
		var_dump($mixed);
		echo '</pre>';
	}
}
/**
 * Makes a summary from a given content string in lenght defined.
 *
 * @param STRING $content
 * @param INTEGER $lenght The maximum size of the summary. Could be shorter.
 * @param BOOLEAN $p Determine if the summary will use <p> elements for breaklines
 * @return void
 */
function substract_summary($content, $lenght, $p = false)
{
	if(strlen($content) <= $lenght)
		return $content;
	
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