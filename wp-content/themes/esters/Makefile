SASSC     = sassc --style compact
COMPSDIR  = assets/styles/components
SASSDIR   = assets/styles
JSDIR     = assets/scripts
DISTDIR   = dist
CSSDIR    = $(DISTDIR)/styles
SASSINC   = $(SASSDIR) $(COMPSDIR)
MANIFEST  = $(DISTDIR)/.manifest
JSBINS    = node_modules/.bin
PHPBINS   = vendor/bin
LRURL     = http://localhost:35729/changed
JSFILES   = $(wildcard $(JSDIR)/bundles/*.js)
SASSFILES = $(shell find $(SASSDIR) -name '*.scss' | grep -v '/_')

# default target
all: build

# build all front-end assets
build: sass requirejs manifest

# run tests
test: test-js test-php

test-js:
	$(JSBINS)/karma start config/karma.conf.js --single-run

test-php:
	$(PHPBINS)/phpunit --stop-on-error --stop-on-failure

# compile a .manifest of all front-end assets
manifest:
	find $(DISTDIR) -type f -exec cksum {} \; | sed -e "s#$(DISTDIR)/##" | cut -f1,3 -d" " >$(MANIFEST)

# compile sass files ito dist css files
sass: $(patsubst $(SASSDIR)/%.scss, $(CSSDIR)/%.css, $(SASSFILES))

# compile sass with the native sass --update syntax
sassupdate:
	$(SASSC) -C $(foreach d, $(SASSINC), -I$d) --update $(SASSDIR):$(CSSDIR)

$(CSSDIR)/%.css: $(SASSDIR)/%.scss
	@echo compiling $@
	@mkdir -p $(shell dirname $@)
	@$(SASSC) -I $(SASSDIR) $? $@

# build production js with requirejs
requirejs: $(patsubst $(JSDIR)/%, $(DISTDIR)/js/%, $(JSFILES))

$(DISTDIR)/js/bundles/%.js: $(JSDIR)/bundles/%.js
	$(JSBINS)/r.js -o $(JSDIR)/build.js include=$(patsubst $(DISTDIR)/js/%.js,%,$@) out=$@

# watch assets for changes in development
watch:
	$(JSBINS)/livereload $(DISTDIR) &
	$(JSBINS)/wach -o "$(DISTDIR)/**/*" make manifest &
	$(SASSC) $(foreach d, $(SASSINC), -I$d) --watch $(SASSDIR):$(CSSDIR)

# set up the tool chain
setup-toolchain:
	@gem list bundler >/dev/null || { gem install bundler --no-rdoc --no-ri; }
	bundle install
	npm install
	composer install --dev --no-interaction
	$(JSBINS)/bower install --allow-root

# clean up only js directory
clean-js:
	-rm -rf $(DISTDIR)/js

# delete npm modules, composer vendors and bower components
clean-toolchain:
	-rm -rf node_modules
	-rm -rf composer_dev
	-rm -rf resources/assets/components

# clean up dist directory
clean:
	-rm -rf $(DISTDIR)
	-rm -rf .sass-cache

# these are targets that don't produce a file of the same name
.PHONY: all clean clean-js clean-toolchain watch sass requirejs manifest test test-php test-js build setup-toolchain
