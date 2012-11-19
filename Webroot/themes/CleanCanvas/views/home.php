<div class="row row-static" id="header">
	<h1 class="span10"><a href="/">Lion Writer</a></h1>
	<div class="sections span1">
		<?php echo $this->link('Archive', '/archive') ?>
	</div>
	<div class="sections span1">
		<?php echo $this->link('About', '/about') ?>
	</div>
	<hr />
</div>

<?php if(isset($pages[0])): $page = array_shift($pages);?>
<div class="row row-static">
	<div class="span8">
	<h2><a href="<?php echo $page['permalink'] ?>"><?php echo $page['title'] ?></a></h2>
	<?php echo $page['content'] ?>
	</div>
</div>
<?php endif; ?>

<div class="row row-static">
	<?php foreach($pages as $page): ?>
	<div class="span4">
		<h3><a href="<?php echo $page['permalink'] ?>"><?php echo $page['title'] ?></a></h3>
		<p><?php echo $page['excerpt'] ?>…</p>
		<p class="page-date"><?php echo $page['date'] ?></p>
	</div>
	<?php endforeach; ?>
</div>


<hr />

<div id="footer" class="container">
	<?php echo $this->element('footer') ?>
</div>
