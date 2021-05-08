<?php
$theme = ThemeLib\Theme::instance();
$shops = $theme->get('customizerSections', 'onlineShops')->getValues();
if (count($shops)) : ?>
<header>
    <div id="order-online__bird"><?= $theme->svg('bird'); ?></div>
    <div id="order-online__logo"><?= $theme->svg('logo'); ?></div>
    <h1>Order Online</h1>
</header>
<nav>
    <ul class="vlist">
        <?php foreach ($shops as $shop) :
            extract($shop, EXTR_PREFIX_ALL, 'shop'); ?>
        <li><a target="_blank" rel="nofollow" href="<?= $shop_url; ?>"><?= htmlspecialchars($shop_title); ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>
<?php endif; ?>
<button class="modal__close-btn clean-btn btn">Close</button>
