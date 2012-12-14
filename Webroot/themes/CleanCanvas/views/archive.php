<?php echo $this->element('header') ?>

<div class="archive-page">
	<h3>All the content in this universe:</h3>
	<ol class="list-pages">
		<?php foreach($pages as $page): ?>
			<li><em class="muted"><?php echo $page['date'] ?></em> <span class="script-dialog">—</span> <a href="<?php echo $page['permalink'] ?>"><?php echo $page['title'] ?></a></li>
		<?php endforeach; ?>
	</ol>
</div>

<?php echo $this->element('footer') ?>
