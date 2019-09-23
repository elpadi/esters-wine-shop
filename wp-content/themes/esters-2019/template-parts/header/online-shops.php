<?php
global $themeData;
$shops = $themeData['onlineShops']->getValues();
if (count($shops)): ?>
<nav>
	<ul class="hlist">
		<?php foreach ($shops as $shop): extract($shop, EXTR_PREFIX_ALL, 'shop'); ?>
		<li><a href="<?= $shop_url; ?>"><?= htmlspecialchars($shop_title); ?></a></li>
		<?php endforeach; ?>
	</ul>
</nav>
<?php endif; ?>
