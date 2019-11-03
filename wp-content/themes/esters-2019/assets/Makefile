.PHONY: none dev prod

FRONT_CSS_FILES := $(shell find src/css/components -type f -name '*.css') $(wildcard src/css/block-editor/blocks/*.css) $(shell find src/css/content -type f -name '*.css')
ADMIN_CSS_FILES := $(wildcard src/css/base/*.css) $(shell find src/css/admin -type f -name '*.css')

#CSS_BUILD_TARGETS := main admin login blocks

CSS_SLICK_DEPS := node_modules/slick-carousel/slick/slick.css node_modules/slick-carousel/slick/slick-theme.css
PAGE_TARGETS := $(addprefix pages/, home about our-menu calendar private-events shop-landing)

CSS_FRONT_TEMPLATE_DEPS := ../../twentynineteen/style.css $(wildcard src/css/*.css) $(wildcard src/css/base/*.css) $(wildcard src/css/header/*.css) $(wildcard src/css/footer/*.css) src/css/content/template.css src/css/content/page.css
CSS_FRONT_PAGE_HOME_DEPS := $(CSS_SLICK_DEPS) src/css/content/home.css
CSS_FRONT_PAGE_ABOUT_DEPS := src/css/content/about.css
CSS_FRONT_PAGE_MENU_DEPS := src/css/components/tabs.css src/css/content/menu.css
CSS_FRONT_PAGE_CALENDAR_DEPS := src/css/content/calendar.css
CSS_FRONT_PAGE_PRIVATE_EVENTS_DEPS := $(CSS_SLICK_DEPS) src/css/content/private-events.css
CSS_FRONT_PAGE_SHOP_LANDING_DEPS := src/css/content/shop-landing.css

CSS_FRONTEND_BUILD_TARGETS := template $(PAGE_TARGETS)

JS_FRONT_APP_DEPS := $(wildcard src/js/base/*.js) src/js/modules/global.js
JS_FRONT_PAGE_DEPS := $(JS_FRONT_APP_DEPS) src/js/modules/page.js
JS_FRONT_PAGE_HOME_DEPS := $(JS_FRONT_APP_DEPS) src/js/modules/pages/home.js src/js/modules/components/slider.js
JS_FRONT_PAGE_ABOUT_DEPS := $(JS_FRONT_PAGE_DEPS) src/js/modules/pages/about.js src/js/modules/components/media/grid.js src/js/modules/components/media/instagram-slider.js src/js/modules/components/social/instagram.js
JS_FRONT_PAGE_MENU_DEPS := $(JS_FRONT_APP_DEPS) src/js/modules/pages/menu.js $(wildcard src/js/modules/components/tabs/*.js)
JS_FRONT_PAGE_CALENDAR_DEPS := $(JS_FRONT_APP_DEPS) src/js/modules/pages/calendar.js src/js/modules/components/posts/listing.js src/js/modules/components/posts/events-listing.js
JS_FRONT_PAGE_PRIVATE_EVENTS_DEPS := $(JS_FRONT_APP_DEPS) src/js/modules/pages/private-events.js src/js/modules/components/slider.js
JS_FRONT_PAGE_SHOP_LANDING_DEPS := $(JS_FRONT_APP_DEPS) src/js/modules/pages/shop-landing.js

JS_FRONTEND_BUILD_TARGETS := page $(PAGE_TARGETS)

none:
	echo "Please select a target."

dist/%.dev.js: src/js/main/%.js
	browserify $^ -o $@ --debug 

dist/%.prod.js: dist/%.dev.js
	babel --compact true --minified -o $@ $^

dist/%.dev.css:
	cleancss --source-map --source-map-inline-sources -O0 $^ -o $@
	postcss -o $@ $@

dist/%.prod.css: dist/%.dev.css
	cleancss -O2 -o $@ $^
	postcss -o $@ $@

src/js/main/frontend/page.js: $(JS_FRONT_PAGE_DEPS)
	touch $@

src/js/main/frontend/pages/home.js: $(JS_FRONT_PAGE_HOME_DEPS)
	touch $@

src/js/main/frontend/pages/about.js: $(JS_FRONT_PAGE_ABOUT_DEPS)
	touch $@

src/js/main/frontend/pages/our-menu.js: $(JS_FRONT_PAGE_MENU_DEPS)
	touch $@

src/js/main/frontend/pages/calendar.js: $(JS_FRONT_PAGE_CALENDAR_DEPS)
	touch $@

src/js/main/frontend/pages/private-events.js: $(JS_FRONT_PAGE_PRIVATE_EVENTS_DEPS)
	touch $@

src/js/main/frontend/pages/shop-landing.js: $(JS_FRONT_PAGE_SHOP_LANDING_DEPS)
	touch $@

dist/frontend/template.dev.css: $(CSS_FRONT_TEMPLATE_DEPS)

dist/frontend/pages/home.dev.css: $(CSS_FRONT_PAGE_HOME_DEPS)

dist/frontend/pages/about.dev.css: $(CSS_FRONT_PAGE_ABOUT_DEPS)

dist/frontend/pages/our-menu.dev.css: $(CSS_FRONT_PAGE_MENU_DEPS)

dist/frontend/pages/calendar.dev.css: $(CSS_FRONT_PAGE_CALENDAR_DEPS)

dist/frontend/pages/private-events.dev.css: $(CSS_FRONT_PAGE_PRIVATE_EVENTS_DEPS)

dist/frontend/pages/shop-landing.dev.css: $(CSS_FRONT_PAGE_SHOP_LANDING_DEPS)

dev: $(addprefix dist/frontend/, $(addsuffix .dev.js, $(JS_FRONTEND_BUILD_TARGETS))) $(addprefix dist/frontend/, $(addsuffix .dev.css, $(CSS_FRONTEND_BUILD_TARGETS)))

prod: $(addprefix dist/frontend/, $(addsuffix .prod.js, $(JS_FRONTEND_BUILD_TARGETS))) $(addprefix dist/frontend/, $(addsuffix .prod.css, $(CSS_FRONTEND_BUILD_TARGETS)))

