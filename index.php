<?php
/**
 * Index
 *
 * The Front Controller for handling every request for use LionWriter with
 * mod_rewrite disabled.
 *
 * PHP 5
 *
 * LionWriter : The most simpler blog engine. (http://lionwriter.com/)
 * Copyright 2012, Juan I. Benavides. (http://juanbenavides.info)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, Juan I. Benavides. (http://juanbenavides.info)
 * @link          http://lionwriter.com LionWriter Project
 * @package       webroot
 * @since         LionWriter v 0.1
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Use the DS to separate the directories in other defines
 */
if(!defined('DS'))
	define('DS', DIRECTORY_SEPARATOR);
/**
 * The full path to the directory which holds 'everything', WITHOUT a trailing DS.
 */
if(!defined('LION_ROOT'))
	define('LION_ROOT', dirname(__FILE__));
/**
 * If you do not want (or can't) use mod_rewrite, uncomment next two lines.
 */
//if(!defined('LION_REWRITE'))
//	define('LION_REWRITE', false);
/**
 * Then we load the webroot index.
 */
require(LION_ROOT.DS.'Webroot'.DS.'index.php')