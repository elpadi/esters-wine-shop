<h3>Address</h3>
<?php if ($contact) : ?>
<p><a href="<?= $contact['map_url']; ?>" target="_blank"><?= nl2br($contact['address']); ?></a></p>
<p>Phone <a href="tel:<?= preg_replace('/[^0-9]/', '-', str_replace(['(',')'], '', $contact['phone'])); ?>"><?= $contact['phone']; ?></a></p>
<?php endif; ?>
