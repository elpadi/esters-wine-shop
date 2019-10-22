.PHONY: none watch-css watch-js prod dev

FRONT_CSS_FILES := $(wildcard src/css/*.css) $(wildcard src/css/base/*.css) $(wildcard src/css/header/*.css) $(wildcard src/css/footer/*.css) $(wildcard src/css/menu/*.css) $(wildcard src/css/block-editor/blocks/*.css) $(shell find src/css/content -type f -name '*.css')
FRONT_JS_FILES := $(shell find src/js -type f -name '*.js')

ADMIN_CSS_FILES := $(wildcard src/css/base/*.css) $(shell find src/css/admin -type f -name '*.css')
ADMIN_JS_FILES := src/js/admin.js $(wildcard src/js/base/*.js) $(shell find src/js/admin -type f -name '*.js')

none:
	echo "Please select a target."

prod: dist/prod.js dist/prod.css dist/admin.prod.js dist/admin.prod.css dist/blocks.css dist/login.css dist/login.js

dev: dist/dev.js dist/dev.css dist/admin.dev.js dist/admin.dev.css dist/blocks.css dist/login.css dist/login.js

watch-js:
	find src/js -type f | entr sh -c 'make dist/dev.js dist/admin.dev.js'

watch-css:
	find src/css -type f | entr sh -c 'make dist/dev.css dist/admin.dev.js dist/blocks.css dist/login.dev.css'

dist/dev.css: $(FRONT_CSS_FILES)
	cleancss --source-map --source-map-inline-sources -O0 $^ -o $@
	postcss -o $@ $@

dist/admin.dev.css: $(ADMIN_CSS_FILES)
	cleancss --source-map --source-map-inline-sources -O0 $^ -o $@
	postcss -o $@ $@

dist/dev.js: package.json $(FRONT_JS_FILES)
	browserify src/js/main.js -o $@ --debug 

dist/admin.dev.js: package.json $(ADMIN_JS_FILES)
	browserify src/js/admin.js -o $@ --debug 

dist/prod.css: $(FRONT_CSS_FILES)
	cleancss -O2 -o $@ $^
	postcss -o $@ $@

dist/admin.prod.css: $(ADMIN_CSS_FILES)
	cleancss -O2 -o $@ $^
	postcss -o $@ $@

dist/login.prod.css: $(wildcard src/css/login/*.css)
	cleancss -O2 -o $@ $^
	postcss -o $@ $@

dist/prod.js: package.json $(FRONT_JS_FILES)
	browserify src/js/main.js -o $@

dist/admin.prod.js: package.json $(ADMIN_JS_FILES)
	browserify src/js/admin.js -o $@ 

dist/blocks.css: $(wildcard src/css/block-editor/blocks/*.css)
	cleancss --source-map --source-map-inline-sources -O0 -o $@ $^

dist/login.css: $(wildcard src/css/login/*.css)
	cleancss --source-map --source-map-inline-sources -O0 $^ -o $@
	postcss -o $@ $@

dist/login.js: $(wildcard src/js/login/*.js)
	babel -o $@ $^

