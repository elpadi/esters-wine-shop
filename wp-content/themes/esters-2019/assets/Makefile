.PHONY: none watch-css watch-js prod dev

CSS_FILES := $(wildcard src/css/*.css) $(wildcard src/css/base/*.css) $(wildcard src/css/header/*.css) $(wildcard src/css/menu/*.css) $(wildcard src/css/block-editor/blocks/*.css) $(wildcard src/css/content/*.css)

JS_FILES := $(shell find src/js -type f -name '*.js')

none:
	echo "Please select a target."

prod: dist/prod.js dist/prod.css dist/blocks.css dist/login.css dist/login.js

dev: dist/dev.js dist/dev.css dist/blocks.css dist/login.css dist/login.js

watch-js:
	find src/js -type f | entr sh -c 'make dist/dev.js'

watch-css:
	find src/css -type f | entr sh -c 'make dist/dev.css dist/blocks.css dist/login.dev.css'

dist/dev.css: $(CSS_FILES)
	cleancss --source-map --source-map-inline-sources -O0 $^ -o $@
	postcss -o $@ $@

dist/dev.js: package.json $(JS_FILES)
	browserify src/js/main.js -o $@ --debug 

dist/prod.css: $(CSS_FILES)
	cleancss -O2 -o $@ $^
	postcss -o $@ $@

dist/login.prod.css: $(wildcard src/css/login/*.css)
	cleancss -O2 -o $@ $^
	postcss -o $@ $@

dist/prod.js: package.json $(JS_FILES)
	browserify src/js/main.js -o $@

dist/blocks.css: $(wildcard src/css/block-editor/blocks/*.css)
	cleancss --source-map --source-map-inline-sources -O0 -o $@ $^

dist/login.css: $(wildcard src/css/login/*.css)
	cleancss --source-map --source-map-inline-sources -O0 $^ -o $@
	postcss -o $@ $@

dist/login.js: $(wildcard src/js/login/*.js)
	babel -o $@ $^

