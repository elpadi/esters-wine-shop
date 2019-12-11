<h3>Connect</h3>
<p><a href="mailto:<?= $contact['email']; ?>"><?= $contact['email']; ?></a></p>
<ul id="theme-footer__social" class="hlist">
	<?php foreach (['instagram','twitter','facebook'] as $social): ?>
	<li><a href="https://<?= $social; ?>.com/<?= $contact[$social]; ?>" target="_blank" rel="nofollow"><?= ThemeLib\Theme::instance()->svg($social,'icons'); ?></a></li>
	<?php endforeach; ?>
</ul>
<div id="theme-footer__newsletter">
	<h3 class="star-heading">Sign Up For Newsletter</h3>
	<?= $contact['newsletter']; ?>
</div>
