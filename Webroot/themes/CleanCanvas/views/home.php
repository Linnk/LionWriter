<?php echo $this->element('header') ?>

<div class="row row-static">
	<?php foreach($pages as $page): ?>
	<div class="span4">
	<a class="page-preview" href="<?php echo $page['permalink'] ?>">
		<?php if(isset($page['image'])): ?>
		<div class="page-image" style="background-image: url('/files/<?php echo $page['image'] ?>')"></div>
		<?php endif; ?>
		<div class="page-excerpt <?php echo isset($page['image']) ? 'with-image' : '' ?>">
			<h4><?php echo $page['title'] ?></h4>
			<p><?php echo $page['excerpt'] ?></p>
		</div>
		<div class="page-footer">
			<em class="muted"><?php echo $page['date'] ?></em>
		</div>
	</a>
	</div>
	<?php endforeach; ?>
</div>


<?php echo $this->element('footer') ?>