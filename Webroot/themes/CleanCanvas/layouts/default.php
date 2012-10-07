<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo isset($title_for_layout) ? $title_for_layout : 'LionWriter' ?></title>
	<meta name="description" content="<?php echo isset($description_for_layout) ? $description_for_layout : 'The content management system for hipster hackers.' ?>" />
	<meta name="keywords" content="<?php echo isset($keywords_for_layout) ? $keywords_for_layout : 'hipster, hacker, content management system' ?>" />
	<link href="<?php echo LION_THEME ?>/img/favicon.ico" type="image/x-icon" rel="icon" />
	<?php echo $this->css('reset'); ?>
	<?php // <link href='http://fonts.googleapis.com/css?family=Overlock:400,700,400italic,700italic' rel='stylesheet' type='text/css'> ?>
	<?php // <link href='http://fonts.googleapis.com/css?family=Gentium+Book+Basic:400,400italic,700,700italic' rel='stylesheet' type='text/css'> ?>
	<?php echo $this->css('lion'); ?>
	<?php echo $this->javascript('mootools-core-1.4.5-full-nocompat-yc'); ?>
	<?php echo $this->javascript('writer'); ?>
</head>
</html>
<body id="LionWriter" class="real">
	<div id="header">
		<div class="container">
			<h1><a href="/">LionWriter</a></h1>
			<div class="sections">
				<?php echo $this->link('Archive', '/archive') ?>
				<?php echo $this->link('About', '/about') ?>
			</div>
			
			<div class="clear">
		</div>
	</div>
	<div id="wrapper">
		<div class="container">
	
<?php echo $content_for_layout ?>
	
		</div>
	</div>
	<div id="footer">
		<?php echo $this->element('footer') ?>
	</div>
</body>
</body>
</html>