<?php
$shops = ThemeLib\Theme::instance()->get('customizerSections', 'onlineShops')->getValues();
if (count($shops)): ?><button class="btn clean-btn modal-btn" data-modal-id="order-online">Order Online!</button><?php endif; ?>
