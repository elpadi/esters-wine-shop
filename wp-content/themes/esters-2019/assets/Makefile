.PHONY: none dev prod

FRONT_CSS_FILES := $(shell find src/css/components -type f -name '*.css') $(wildcard src/css/block-editor/blocks/*.css) $(shell find src/css/content -type f -name '*.css')
ADMIN_CSS_FILES := $(wildcard src/css/base/*.css) $(shell find src/css/admin -type f -name '*.css')

#CSS_BUILD_TARGETS := main admin login blocks

CSS_SLICK_DEPS := node_modules/slick-carousel/slick/slick.css node_modules/slick-carousel/slick/slick-theme.css
PAGE_TARGETS := $(addprefix pages/, home about our-menu calendar private-events shop-landing)
SHOP_TARGETS := $(addprefix shop/, product-listing product cart checkout account)
ADMIN_TARGETS := customizer

CSS_FRONT_TEMPLATE_DEPS := src/css/fonts.css ../../twentynineteen/style.css $(wildcard src/css/base/*.css) src/css/components/modal.css $(wildcard src/css/header/*.css) $(wildcard src/css/footer/*.css) src/css/content/template.css src/css/content/page.css src/css/content/shop.css src/css/content/notices.css src/css/content/order-online.css src/css/responsive/header.css src/css/responsive/footer.css
CSS_FRONT_PAGE_HOME_DEPS := $(CSS_SLICK_DEPS) src/css/content/home.css
CSS_FRONT_PAGE_ABOUT_DEPS := $(CSS_SLICK_DEPS) src/css/content/about.css
CSS_FRONT_PAGE_MENU_DEPS := src/css/components/tabs.css src/css/content/menu.css
CSS_FRONT_PAGE_CALENDAR_DEPS := src/css/content/calendar.css
CSS_FRONT_PAGE_PRIVATE_EVENTS_DEPS := $(CSS_SLICK_DEPS) src/css/content/private-events.css
CSS_FRONT_SHOP_LANDING_DEPS := src/css/content/shop-landing.css
CSS_FRONT_SHOP_LISTING_DEPS := src/css/content/product-listing.css
CSS_FRONT_SHOP_PRODUCT_DEPS := src/css/content/product-listing.css src/css/content/product.css
CSS_FRONT_SHOP_CART_DEPS := src/css/content/cart.css
CSS_FRONT_SHOP_CHECKOUT_DEPS := src/css/content/checkout.css
CSS_FRONT_SHOP_ACCOUNT_DEPS := src/css/content/account.css

CSS_FRONTEND_BUILD_TARGETS := template $(PAGE_TARGETS) $(SHOP_TARGETS)

JS_APP_DEPS := $(wildcard src/js/base/*.js) src/js/modules/global.js src/js/modules/esters.js src/js/modules/modal.js

JS_FRONT_PAGE_DEPS := src/js/modules/page.js src/js/modules/pages/columnize-text.js
JS_FRONT_PAGE_HOME_DEPS := src/js/modules/pages/home.js src/js/modules/components/slider.js
JS_FRONT_PAGE_ABOUT_DEPS := src/js/modules/pages/about.js src/js/modules/components/media/instagram-slider.js src/js/modules/components/maps/google-map.js
JS_FRONT_PAGE_MENU_DEPS := src/js/modules/pages/menu.js $(wildcard src/js/modules/components/tabs/*.js)
JS_FRONT_PAGE_CALENDAR_DEPS := src/js/modules/pages/calendar.js src/js/modules/components/posts/listing.js src/js/modules/components/posts/events-listing.js
JS_FRONT_PAGE_PRIVATE_EVENTS_DEPS := src/js/modules/pages/private-events.js src/js/modules/components/slider.js
JS_FRONT_SHOP_LANDING_DEPS := src/js/modules/pages/shop-landing.js
JS_FRONT_SHOP_LISTING_DEPS := src/js/modules/shop/product-listing.js
JS_FRONT_SHOP_PRODUCT_DEPS := src/js/modules/shop/product.js
JS_FRONT_SHOP_CART_DEPS := src/js/modules/shop/cart.js

JS_FRONTEND_BUILD_TARGETS := page $(PAGE_TARGETS) $(SHOP_TARGETS)

JS_ADMIN_CUSTOMIZER_DEPS := $(wildcard src/js/admin/customizer/*.js)

DEV_TARGETS := dist/app.dev.js $(addprefix dist/frontend/, $(addsuffix .dev.js, $(JS_FRONTEND_BUILD_TARGETS))) $(addprefix dist/frontend/, $(addsuffix .dev.css, $(CSS_FRONTEND_BUILD_TARGETS))) $(addprefix dist/admin/, $(addsuffix .dev.js, $(ADMIN_TARGETS)))
PROD_TARGETS := $(subst .dev.,.prod.,$(DEV_TARGETS))

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

src/js/main/app.js: $(JS_APP_DEPS)
	touch $@

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

src/js/main/frontend/shop/product-listing.js: $(JS_FRONT_SHOP_LISTING_DEPS)
	touch $@

src/js/main/frontend/shop/product.js: $(JS_FRONT_SHOP_PRODUCT_DEPS)
	touch $@

src/js/main/frontend/shop/cart.js: $(JS_FRONT_SHOP_CART_DEPS)
	touch $@

src/js/main/frontend/shop/checkout.js:
	touch $@

src/js/main/frontend/shop/account.js:
	touch $@

src/js/main/admin/customizer.js: $(JS_ADMIN_CUSTOMIZER_DEPS)
	touch $@

dist/frontend/template.dev.css: $(CSS_FRONT_TEMPLATE_DEPS)

dist/frontend/pages/home.dev.css: $(CSS_FRONT_PAGE_HOME_DEPS)

dist/frontend/pages/about.dev.css: $(CSS_FRONT_PAGE_ABOUT_DEPS)

dist/frontend/pages/our-menu.dev.css: $(CSS_FRONT_PAGE_MENU_DEPS)

dist/frontend/pages/calendar.dev.css: $(CSS_FRONT_PAGE_CALENDAR_DEPS)

dist/frontend/pages/private-events.dev.css: $(CSS_FRONT_PAGE_PRIVATE_EVENTS_DEPS)

dist/frontend/pages/shop-landing.dev.css: $(CSS_FRONT_SHOP_LANDING_DEPS)

dist/frontend/shop/product-listing.dev.css: $(CSS_FRONT_SHOP_LISTING_DEPS)

dist/frontend/shop/product.dev.css: $(CSS_FRONT_SHOP_PRODUCT_DEPS)

dist/frontend/shop/cart.dev.css: $(CSS_FRONT_SHOP_CART_DEPS)

dist/frontend/shop/checkout.dev.css: $(CSS_FRONT_SHOP_CHECKOUT_DEPS)

dist/frontend/shop/account.dev.css: $(CSS_FRONT_SHOP_ACCOUNT_DEPS)

dev: $(DEV_TARGETS)

prod: $(PROD_TARGETS)

src/js/modules/pages/about.js: src/js/modules/components/media/grid.js 
	touch $@

src/js/modules/components/media/instagram-slider.js: src/js/modules/components/slider.js src/js/modules/components/social/instagram.js
	touch $@

src/js/modules/components/maps/google-map.js: src/js/modules/components/maps/map.js
	touch $@

