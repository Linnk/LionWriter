<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo isset($title_for_layout) ? $title_for_layout : 'LionWriter' ?></title>
	<meta name="description" content="<?php echo isset($excerpt_for_layout) ? $excerpt_for_layout : 'The content management system for hipster hackers.' ?>" />
	<meta name="keywords" content="<?php echo isset($keywords_for_layout) ? $keywords_for_layout : 'hipster, hacker, content management system' ?>" />
	<link href="/favicon.ico" type="image/x-icon" rel="icon" />
</head>
</html>
<body>
	<h1>LionWriter</h1>
	<hr />

<?php echo $content_for_layout ?>

<?php echo $this->element('footer') ?>
</body>
</html>