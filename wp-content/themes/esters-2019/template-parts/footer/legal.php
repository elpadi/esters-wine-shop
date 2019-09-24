<?php
global $themeData;
$legal = current($themeData['legal']->getValues());
?>
<p id="legal__copyright"><?= str_replace('%year%', date('Y'), $legal['copyright']); ?></p>
<ul id="legal__pages" class="hlist">
	<?php foreach (['tnc','privacy','tou'] as $key): $page = $legal[$key]; ?>
	<li><a href="<?= get_permalink($page); ?>"><?= $page->post_title; ?></a></li>
	<?php endforeach; ?>
</ul>
