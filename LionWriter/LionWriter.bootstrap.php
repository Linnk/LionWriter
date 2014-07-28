<?php

error_reporting(E_ALL);

require(LION_CORE.DS.'LionWriter.functions.php');
require(LION_CORE.DS.'LionWriter.Core.php');
require(LION_CORE.DS.'LionWriter.Theme.php');

LionWriter::prepareForDispatch();

require(LION_WEBROOT.DS.'configuration.php');

define('LION_SITE', LION_WEBROOT.DS.'themes'.DS.LionWriter::theme());
define('LION_THEME', DS.'themes'.DS.LionWriter::theme());

if(file_exists(LION_SITE.DS.'configuration.php'))
	require(LION_SITE.DS.'configuration.php');

LionWriter::dispatch();
