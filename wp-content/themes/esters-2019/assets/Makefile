.PHONY: none watch-css watch-js prod dev

FRONT_CSS_FILES := $(shell find src/css/components -type f -name '*.css') $(wildcard src/css/block-editor/blocks/*.css) $(shell find src/css/content -type f -name '*.css')
ADMIN_CSS_FILES := $(wildcard src/css/base/*.css) $(shell find src/css/admin -type f -name '*.css')

#CSS_BUILD_TARGETS := main admin login blocks

CSS_SLICK_DEPS := node_modules/slick-carousel/slick/slick.css node_modules/slick-carousel/slick/slick-theme.css

CSS_FRONT_TEMPLATE_DEPS := ../../twentynineteen/style.css $(wildcard src/css/*.css) $(wildcard src/css/base/*.css) $(wildcard src/css/header/*.css) $(wildcard src/css/footer/*.css) src/css/content/page.css
CSS_FRONT_PAGE_HOME_DEPS := $(CSS_SLICK_DEPS) src/css/content/home.css
CSS_FRONT_PAGE_ABOUT_DEPS := src/css/content/about.css
CSS_FRONT_PAGE_MENU_DEPS := src/css/components/tabs.css src/css/content/menu.css

CSS_FRONTEND_BUILD_TARGETS := template pages/home pages/about pages/our-menu

JS_FRONT_PAGE_DEPS := src/js/main/frontend/page.js src/js/modules/page.js
JS_FRONT_PAGE_HOME_DEPS := src/js/main/frontend/pages/home.js src/js/modules/pages/home.js src/js/modules/components/slider.js
JS_FRONT_PAGE_ABOUT_DEPS := $(JS_FRONT_PAGE_DEPS) src/js/main/frontend/pages/about.js src/js/modules/pages/about.js src/js/modules/components/media/grid.js src/js/modules/components/media/instagram-slider.js src/js/modules/components/social/instagram.js
JS_FRONT_PAGE_MENU_DEPS := src/js/main/frontend/pages/our-menu.js src/js/modules/pages/menu.js $(wildcard src/js/modules/components/tabs/*.js)

JS_FRONTEND_BUILD_TARGETS := page pages/home pages/about pages/our-menu

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

dist/frontend/page.dev.js: $(JS_FRONT_PAGE_DEPS)

dist/frontend/pages/home.dev.js: $(JS_FRONT_PAGE_HOME_DEPS)

dist/frontend/pages/about.dev.js: $(JS_FRONT_PAGE_ABOUT_DEPS)

dist/frontend/pages/our-menu.dev.js: $(JS_FRONT_PAGE_MENU_DEPS)

dist/frontend/template.dev.css: $(CSS_FRONT_TEMPLATE_DEPS)

dist/frontend/pages/home.dev.css: $(CSS_FRONT_PAGE_HOME_DEPS)

dist/frontend/pages/about.dev.css: $(CSS_FRONT_PAGE_ABOUT_DEPS)

dist/frontend/pages/our-menu.dev.css: $(CSS_FRONT_PAGE_MENU_DEPS)

dev: $(addprefix dist/frontend/, $(addsuffix .dev.js, $(JS_FRONTEND_BUILD_TARGETS))) $(addprefix dist/frontend/, $(addsuffix .dev.css, $(CSS_FRONTEND_BUILD_TARGETS)))

prod: $(addprefix dist/frontend/, $(addsuffix .prod.js, $(JS_FRONTEND_BUILD_TARGETS))) $(addprefix dist/frontend/, $(addsuffix .prod.css, $(CSS_FRONTEND_BUILD_TARGETS)))

