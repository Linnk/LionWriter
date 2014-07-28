<div class="container">

<?php echo $this->element('header') ?>

<div class="row">
	<div class="col-sm-6">
		<pre>
		               ________
		          _,.-Y  |  |  Y-._
		      .-~"   ||  |  |  |   "-.
		      I" ""=="|" !""! "|"[]""|     _____
		      L__  [] |..------|:   _[----I" .-{"-.
		     I___|  ..| l______|l_ [__L]_[I_/r(=}=-P
		    [L______L_[________]______j~  '-=c_]/=-^
		     \_I_j.--.\==I|I==_/.--L_]
		       [_((==)[`-----"](==)j
		          I--I"~~"""~~"I--I
		          |[]|         |[]|
		          l__j         l__j
		          |!!|         |!!|
		          |..|         |..|
		          ([])         ([])
		          ]--[         ]--[
		          [_L]         [_L]  
		         /|..|\       /|..|\
		        `=}--{='     `=}--{='
		       .-^--r-^-.   .-^--r-^-.
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		</pre>
	</div>
	<div class="col-sm-6">
		<?php echo $this->getContent('getting-started.md') ?>
	</div>
</div>

<hr />

<div class="row home-page">
	<?php foreach($pages as $page): ?>
	<div class="col-sm-4">
	<a class="page-preview" href="<?php echo $page['permalink'] ?>">
		<?php if(isset($page['image'])): ?>
		<div class="page-image-preview" style="background-image: url('<?php echo LION_THEME.DS.'img'.DS.$page['image'] ?>')"></div>
		<?php endif; ?>
		<div class="page-excerpt <?php echo isset($page['image']) ? 'with-image' : '' ?>">
			<h4><?php echo $page['title'] ?></h4>
			<p><?php echo $page['excerpt'] ?></p>
		</div>
		<div class="page-footer">
			<em class="text-muted"><?php echo $page['date'] ?></em>
		</div>
	</a>
	</div>
	<?php endforeach; ?>
</div>

</div>

<?php echo $this->element('footer') ?>