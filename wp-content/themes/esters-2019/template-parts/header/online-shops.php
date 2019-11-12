<?php
global $themeData;
$shops = $themeData['onlineShops']->getValues();
if (count($shops)): ?><button class="btn clean-btn modal-btn" data-modal-id="order-online">Order Online!</button><?php endif; ?>
