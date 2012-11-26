<div class="single-page <?php echo isset($page['image']) ? 'with-image' : '' ?>">
	<?php if(isset($page['image'])): ?>
	<div class="page-image">
		<img src="/files/<?php echo $page['image'] ?>" class="img " width="100%"/>
	</div>
	<?php endif; ?>
	<h1><?php echo $page['title'] ?></h1>
	<?php echo $page['content'] ?>
	
	<?php echo $this->element('page-author') ?>
</div>
