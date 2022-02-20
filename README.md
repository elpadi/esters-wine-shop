# Esters Wine Shop

Wordpress website for [Esters Wine Shop](https://www.esterswineshop.com/).

## Development

The standard development environment uses [lando](https://docs.lando.dev/).

### Instructions

1. Install lando.
2. Clone the repo, including sub-modules (`--recurse-submodules`).
3. Run `lando start`.
4. Import content.

### Adding content

`lando wp {args}` allows you to run [wp-cli](https://developer.wordpress.org/cli/commands/) commands.

You import an entire database with `lando wp db import {file}`,
and then replace the URLs with
`lando wp search-replace www.esterswineshop.com esters-wine-shop.lndo.site --precise --recurse-objects`.
Make sure that the DB dump is inside the repo, e.g. `lando/db.sql`, otherwise lando will not have access to it.

You can also [import the content from a WP export](https://developer.wordpress.org/cli/commands/import/) WXR file.

### Managing front-end assets

`lando yarn {args}` will run [yarn](https://yarnpkg.com/getting-started) on the assets directory
of the theme. Use it to manage NPM dependencies.

`lando make {args}` will run [make](https://www.gnu.org/software/make/) on the assets directory
of the theme. Use it to build the front-end assets.
