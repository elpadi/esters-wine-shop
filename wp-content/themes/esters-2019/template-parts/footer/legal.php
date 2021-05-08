<?php

global $themeData;
$legal = current(ThemeLib\Theme::instance()->get('customizerSections', 'legal')->getValues());
?>
<p id="legal__copyright">
    <?= str_replace('%year%', date('Y'), $legal ? $legal['copyright'] : ''); ?>
    <?= $legal ? implode(' <span class="separator">&bull;</span> ', array_filter(Functional\map(['tnc', 'privacy', 'tou', 'accessibility'], function ($key) use ($legal) {
        $page = $legal[$key];
        return $page ? sprintf('<a href="%s">%s</a>', get_permalink($page), $page->post_title) : '';
    }))) : ''; ?>
</p>
