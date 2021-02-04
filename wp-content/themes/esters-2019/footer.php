<?php
$contact = current(ThemeLib\Theme::instance()->get('customizerSections', 'contactInfo')->getValues());
$f_tpl = function ($s) use ($contact) {
    include(__DIR__ . "/template-parts/footer/$s.php");
};
?>
    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="columns">
            <div id="theme-footer__address" class="col"><?php $f_tpl('address'); ?></div>
            <div id="theme-footer__hours" class="col"><?php $f_tpl('hours'); ?></div>
            <div id="theme-footer__connect" class="col"><?php $f_tpl('connect'); ?></div>
        </div>
        <?php if ($contact && $contact['family_heading_text']) : ?>
        <h2 id="footer__family-heading" class=""><a target="_blank" rel="nofollow" href="<?= $contact['family_heading_url'] ? $contact['family_heading_url'] : '#'; ?>"><?= $contact['family_heading_text']; ?></a></h2>
        <?php endif; ?>
        <div id="theme-footer__legal"><?php $f_tpl('legal'); ?></div>
    </footer><!-- #colophon -->

</div><!-- #page -->
<div id="order-online-modal" class="modal"><?php include(__DIR__ . "/template-parts/modal/order-online.php"); ?></div>
<?php
wp_footer();
//include(__DIR__.'/template-parts/components/spinner.php');
?></body>
</html>
