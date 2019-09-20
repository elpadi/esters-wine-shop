<?php
global $themeData;
$slides = $themeData['homeSlides']->getValues();
if (count($slides)): ?>
<ul id="home-slideshow">
	<?php foreach ($slides as $slide): extract($slide, EXTR_PREFIX_ALL, 'slide'); ?>
	<li>
		<h2><?= htmlspecialchars($slide_title); ?></h2>
		<h3><?= htmlspecialchars($slide_byline); ?></h3>

		<?php if ($slide_page): ?>
		<h4><a href="<?= get_the_permalink($slide_page); ?>"><?= $slide_page->post_title; ?></a></h4>
		<?php endif; ?>

		<?= $slide_image; ?>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
