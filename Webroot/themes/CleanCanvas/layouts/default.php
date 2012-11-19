<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo isset($title_for_layout) ? $title_for_layout : 'The Lion Writer' ?></title>
	<meta name="description" content="<?php echo isset($description_for_layout) ? $description_for_layout : 'The content management system for hipster hackers.' ?>" />
	<meta name="keywords" content="<?php echo isset($keywords_for_layout) ? $keywords_for_layout : 'hipster, hacker, content management system' ?>" />
	<link href="<?php echo LION_THEME ?>/img/favicon.ico" type="image/x-icon" rel="icon" />
	<?php echo $this->css('bootstrap'); ?>
	<?php echo $this->css('cleancanvas'); ?>
</head>
</html>
<body id="LionWriter" class="real">

	<div class="container">
<?php echo $content_for_layout ?>
	</div>

</body>
</body>
</html>