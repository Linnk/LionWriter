<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo isset($title_for_layout) ? $title_for_layout : 'The Lion Writer' ?></title>
	<meta name="description" content="<?php echo isset($description_for_layout) ? $description_for_layout : 'The content management system for hipster hackers.' ?>" />
	<meta name="keywords" content="<?php echo isset($keywords_for_layout) ? $keywords_for_layout : 'hipster, hacker, content management system' ?>" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link href="<?php echo LION_THEME ?>/img/favicon.ico" type="image/x-icon" rel="icon" />
	<link rel="stylesheet" href="<?php echo LION_THEME ?>/bootstrap-v3.2/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo LION_THEME ?>/css/bluworks-docs.css" />
	<link rel="stylesheet" href="<?php echo LION_THEME ?>/highlight/styles/tomorrow-night.css" />
	<script src="<?php echo LION_THEME ?>/highlight/highlight.pack.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
</head>
</html>
<body id="LionWriter" class="real">

<?php echo $content_for_layout ?>

</body>
</html>