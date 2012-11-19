<?php echo $this->element('header') ?>

<hr />

<h2>All the content in this universe:</h2>
<ol class="list-pages">
	<?php foreach($pages as $page): ?>
		<li><span class="page-date muted"><?php echo $page['date'] ?></span> <span class="script-dialog">—</span> <a href="<?php echo $page['permalink'] ?>"><?php echo $page['title'] ?></a></li>
	<?php endforeach; ?>
</ol>

<?php echo $this->element('footer') ?>
