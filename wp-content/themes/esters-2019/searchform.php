<form role="search" method="get" class="search-form" action="<?= esc_url(home_url('/')); ?>">
	<input type="hidden" name="post_type" value="product">
	<label>
		<span class="screen-reader-text">Search for</span>
		<input type="search"
			class="search-field"
			placeholder="Search &hellip;"
			value="<?= get_search_query(); ?>"
			name="s">
	</label>
	<button type="reset" class="clean-btn btn"><?= ThemeLib\Theme::instance()->svg('no-alt','icons'); ?></button>
	<button class="clean-btn btn"><?= ThemeLib\Theme::instance()->svg('search','icons'); ?></button>
</form>
