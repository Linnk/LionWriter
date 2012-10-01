<!DOCTYPE html>
<html>
<head>
	<title><?php echo isset($title_for_layout) ? $title_for_layout : 'LionWriter' ?></title>
	<meta name="description" content="<?php echo isset($excerpt_for_layout) ? $excerpt_for_layout : 'The content management system for hipster hackers.' ?>"
	<meta name="keywords" content="<?php echo isset($keywords_for_layout) ? $keywords_for_layout : 'hipster, hacker, content management system' ?>"
</head>
</html>
<body>
	<h1>LionWriter</h1>

<?php echo $content_for_layout ?>

</body>
</html>