<h2>Default view</h2>
<?php if(isset($page)): ?>

	<p>I just recieve a page: </p>
	<?php pr($page) ?>

<?php elseif(isset($pages)): ?>

	<p>I just recieve some pages: </p>
	<?php pr($pages) ?>

<?php else: ?>

	<p>I didn't recieve anything :( </p>

<?php endif; ?>