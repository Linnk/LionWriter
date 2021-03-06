<?php
/**
 * Index
 *
 * The Front Controller for handling every request
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
 * These defines should only be edited if you have cake installed in
 * a directory layout other than the way it is distributed.
 * When using custom settings be sure to use the DS and do not add a trailing DS.
 */
/**
 * The full path to the directory which holds 'app', WITHOUT a trailing DS.
 *
 */
if (!defined('LION_ROOT'))
	define('LION_ROOT', dirname(dirname(__FILE__)));
/**
 * If you do not want (or can't) use mod_rewrite, set next constant to false.
 */
if(!defined('LION_REWRITE'))
	define('LION_REWRITE', true);
/**
 * The absolute path to the “LionWriter” directory, WITHOUT a trailing DS.
 */
define('LION_CORE', LION_ROOT.DS.'LionWriter');
/**
 * The absolute path to the “Content” directory, WITHOUT a trailing DS.
 */
define('LION_CONTENT', LION_ROOT.DS.'Content');
/**
 * The absolute path to the “Webroot” directory, WITHOUT a trailing DS.
 */
define('LION_WEBROOT', dirname(__FILE__));
/**
 * The absolute path to the “Webroot/themes” directory, WITHOUT a trailing DS.
 */
define('LION_THEMES', LION_WEBROOT.DS.'themes');

/**
 *
 * Editing below this line should NOT be necessary.
 * Change it at your own risk.
 *
 */
if(!include(LION_CORE.DS.'LionWriter.bootstrap.php'))
{
	trigger_error('LionWriter core could not be found. Check the value of LION_CORE in WWW/Webroot/index.php. It should point to the directory containing your '.DS.'LionWriter core directory and your '.DS.'vendors root directory.', E_USER_ERROR);
}