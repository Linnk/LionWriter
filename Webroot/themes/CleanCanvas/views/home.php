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

<div class="row row-static">
	<?php foreach($pages as $page): ?>
	<div class="span4">
	<div class="page-preview">
		<h4><a href="<?php echo $page['permalink'] ?>"><?php echo $page['title'] ?></a></h4>
		<p class="page-excerpt"><?php echo $page['excerpt'] ?>…</p>
		<p class="page-date muted"><?php echo $page['date'] ?></p>
	</div>
	</div>
	<?php endforeach; ?>
</div>


<hr />

<div id="footer" class="container">
	<?php echo $this->element('footer') ?>
</div>
