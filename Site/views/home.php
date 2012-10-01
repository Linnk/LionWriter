<h2>Home view</h2>

<p>Cool, custom views are working!</p>

<ul>
<?php foreach($pages as $page): ?>
	<li><a href="#"><?php echo $page['title'] ?></a></li>
<?php endforeach; ?>
</ul>