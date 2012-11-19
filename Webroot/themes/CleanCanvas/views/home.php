<?php echo $this->element('header') ?>

<br />

<div class="row row-static">
	<?php foreach($pages as $page): ?>
	<div class="span4">
	<div class="page-preview">
		<h4><a href="<?php echo $page['permalink'] ?>"><?php echo $page['title'] ?></a></h4>
		<p class="page-excerpt"><?php echo $page['excerpt'] ?>…</p>
		<p class="muted"><em><?php echo $page['date'] ?></em></p>
	</div>
	</div>
	<?php endforeach; ?>
</div>


<?php echo $this->element('footer') ?>