<?php echo $this->element('header') ?>

<div class="row row-static">
	<?php foreach($pages as $page): ?>
	<div class="span4">
	<div class="page-preview">
		<?php /* if(isset($page['image'])): ?>
		<div class="page-image">
			<img src="/files/<?php echo $page['image'] ?>" class="img " width="100%"/>
		</div>
		<?php endif; */?>
		<?php if(isset($page['image'])): ?>
		<div class="page-image" style="background-image: url('/files/<?php echo $page['image'] ?>')"></div>
		<?php endif; ?>
		<div class="page-excerpt <?php echo isset($page['image']) ? 'with-image' : '' ?>">
			<h4><a href="<?php echo $page['permalink'] ?>"><?php echo $page['title'] ?></a></h4>
			<?php echo $page['excerpt'] ?>
		</div>
		<div class="page-footer">
			<em class="muted"><?php echo $page['date'] ?></em>
		</div>
	</div>
	</div>
	<?php endforeach; ?>
</div>


<?php echo $this->element('footer') ?>