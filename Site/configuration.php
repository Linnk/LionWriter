<?php
/**
 * Site configuration
 *
 * In this file, you set up routes to your contents and their views.
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
 * First, we are connecting '/' (base path) to all the 'articles' in
 * the Content, but this will fetch all in sort descending. That's why
 * you must setup a special view to show properly.
 */
	LionWriter::route('/', array(
		'content' 	=> 'articles/',
		'view' 		=> 'home',
		'layout' 	=> 'default',
	));
/**
 * For each article we are connecting every request with the format '/:title/:Y/:m'
 * with a query in articles folder inside the Content. Your articles must have this
 * name format: “Y-m-d-title.md”. Doesn't matter that the request don't use every
 * token.
 */
	LionWriter::route('/:title/:Y/:m', array(
		'content' 	=> 'articles/{query}.md',
		'view' 		=> 'default',
	));
/**
 * For individual pages like the “About page” you can setup this way. The layout &
 * view will be “default” and the content will be specifically “about-me-page.md”.
 */
	LionWriter::route('/about', array('content' => 'about-me-page.md'));
/**
 * Setup a default view is very usefull for automatic loading content.
 * If someone make a request to '/contact' path, it will try to find a
 * contact.md file and try render it with the default layout and default view.
 */
