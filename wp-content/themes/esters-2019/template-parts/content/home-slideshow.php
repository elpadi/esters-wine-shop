<ul id="home-slideshow">
	<?php foreach ((new ThemeLib\ACF\HomeFields())->getRepeaterValues('slider') as $slide): extract($slide, EXTR_PREFIX_ALL, 'slide'); ?>
	<li>
		<h2><?= htmlspecialchars($slide_hero_title); ?></h2>
		<h3><?= nl2br(htmlspecialchars($slide_sub_copy)); ?></h3>

		<?php if ($slide_page): ?>
		<h4><a class="btn" href="<?= $slide_page; ?>">View <span class="arrow">&gt;</span></a></h4>
		<?php endif; ?>

		<?= $slide_image; ?>
	</li>
	<?php endforeach; ?>
</ul>
