<?php if(isset($page['image'])): ?>
<div class="page-image">
	<img src="<?php echo LION_THEME.DS.'img'.DS.$page['image'] ?>" class="img " width="100%"/>
</div>
<?php endif; ?>

<div class="single-page <?php echo isset($page['image']) ? 'with-image' : '' ?>">
	<?php echo $page['content'] ?>
	
	<?php echo $this->element('page-author') ?>
</div>
