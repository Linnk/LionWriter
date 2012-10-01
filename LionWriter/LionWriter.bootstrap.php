<?php

error_reporting(E_ALL);

require(LION_CORE.DS.'LionWriter.functions.php');
require(LION_CORE.DS.'LionWriter.Core.php');
require(LION_CORE.DS.'LionWriter.View.php');

require(LION_CORE.DS.'vendors'.DS.'markdown.php');

if(file_exists(LION_SITE.DS.'bootstrap.php'))
	require(LION_SITE.DS.'bootstrap.php');

LionWriter::dispatch();
