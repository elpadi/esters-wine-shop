<?php

if (!defined('RESY_API_KEY')) {
    return;
}
?>
<a
    href="https://resy.com/cities/la/esters-wine-shop-and-bar"
    class="resy-btn"
>Book Table</a>
<script src="https://widgets.resy.com/embed.js" defer async>
    for (let btn of document.getElementsByClassName('resy-btn')) {
        resyWidget.addButton(
            btn,
            {
                "venueId": 37990,
                "apiKey": "<?= RESY_API_KEY; ?>",
                "replace": true
            }
        );
    }
</script>
