<?php

error_reporting(E_ALL);

require(LION_CORE.DS.'LionWriter.functions.php');
require(LION_CORE.DS.'LionWriter.Core.php');
require(LION_CORE.DS.'LionWriter.Theme.php');

LionWriter::prepareForDispatch();

require(LION_WEBROOT.DS.'configuration.php');

if(file_exists(LION_SITE.DS.'bootstrap.php'))
	require(LION_SITE.DS.'bootstrap.php');

LionWriter::dispatch();
