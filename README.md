# WordPress Plugin Boilerplate Generator

[![GitHub tags](https://img.shields.io/github/tag/dotherightthing/generator-wp-plugin-boilerplate.svg)](https://github.com/dotherightthing/generator-wp-plugin-boilerplate/tags) [![Build Status](https://travis-ci.org/dotherightthing/generator-wp-plugin-boilerplate.svg?branch=master)](https://travis-ci.org/dotherightthing/generator-wp-plugin-boilerplate) [![GitHub issues](https://img.shields.io/github/issues/dotherightthing/generator-wp-plugin-boilerplate.svg)](https://github.com/dotherightthing/generator-wp-plugin-boilerplate/issues)

Generates a best-practice boilerplate for [WordPress](https://wordpress.org/) plugin development.

## Installation

### A. Create a Git repo to store the code

1. Create a remote Git repo `wpdtrt-mypluginname` - note that the name `wpdtrt-plugin` is reserved. [Github instructions](https://help.github.com/articles/create-a-repo/)
1. Clone `wpdtrt-mypluginname` to your local computer

### B. Install the generator dependencies

1. [Composer](https://getcomposer.org/download/)
1. [Node.js & NPM](https://nodejs.org/)
1. [Bower](https://bower.io/): `$ npm install -g bower`
1. [Gulp](https://gulpjs.com/): `$ sudo npm install -g gulp-cli`
1. [Yeoman](http://yeoman.io/): `$ sudo npm install -g yo`
1. [GraphViz](http://graphviz.org/download/), for graphs in PHPDoc (optional)

This process is also automated:

* by Travis CI
* from `generator-wp-plugin-boilerplate/.travis.yml`
* in tasks `before_install` and `install`

### C. Install the generator

1. `$ git clone https://github.com/dotherightthing/generator-wp-plugin-boilerplate.git`
1. `$ cd generator-wp-plugin-boilerplate`
1. `$ npm install`
1. `$ sudo npm link`

This process is also automated:

* by Travis CI
* from `generator-wp-plugin-boilerplate/.travis.yml`
* in task `install`

### D. Use the generator to scaffold a custom plugin

1. `$ cd wpdtrt-mypluginname`
1. `$ yo wp-plugin-boilerplate`

This process is also automated:

* by Travis CI
* from `generator-wp-plugin-boilerplate/.travis.yml`
* in task `script`

### E. Yeoman runs

1. The config options are used to customise a set of base files
1. The latest tagged version of [wpdtrt-plugin](https://github.com/dotherightthing/wpdtrt-plugin) is installed via Composer
1. `wpdtrt-plugin`'s Gulp/Node dependencies are installed
1. The WordPress Unit Testing framework is installed
1. `wpdtrt-plugin`'s PHPUnit tests are run
1. `wpdtrt-plugin`'s Gulp build task (`gulp dist`) is run

This process is automated:

* by Yeoman
* from `generator-wp-plugin-boilerplate/generators/app/index.js`
* in task `install`

### F. Gulp runs

1. `wpdtrt-mypluginname`'s Bower (front-end) dependencies are installed
1. `wpdtrt-mypluginname`'s Composer (PHP) dependencies are installed, including development libraries specified by `wpdtrt-plugin`
1. `wpdtrt-mypluginname`'s SCSS files are compiled into SCSS
1. `wpdtrt-mypluginname`'s JS files are linted and documented
1. `wpdtrt-mypluginname`'s PHP files are linted and documented
1. `wpdtrt-mypluginname`'s WordPress-friendly `./release.zip` is generated

This process is automated:

* by Gulp
* from `wpdtrt-mypluginname/vendor/dotherightthing/wpdtrt-plugin/gulpfile.js`
* in task `dist`
* on `wpdtrt-mypluginname/*`

This task can also be run on `wpdtrt-mypluginname` after it has been cloned from its own Git repo, see [Develop child plugins](https://github.com/dotherightthing/wpdtrt-plugin#develop-child-plugins-or-maintain-this-one).

### G. Set up Travis CI

1. https://travis-ci.org/
1. https://travis-ci.org/profile/yourtravisusername
1. Sync account
1. Flick the `wpdtrt-mypluginname` repository switch to 'on'
1. This adds a commit hook to https://github.com/~/wpdtrt-mypluginname/settings/installations

Tip: [CCMenu](http://ccmenu.org/) displays the build status of projects on a continuous integration server as an item in the Mac's menu bar

### H. Set up tokens for Travis CI

1. https://travis-ci.org/yourtravisusername/wpdtrt-mypluginname/settings > Environmental Variables

#### Github Releases

1. Name: `GITHUB_AUTH`
1. Value: <https://github.com/settings/tokens> > Generate new token > `repo:public_repo`

Tip: This key should not be encrypted. Wrap the value in single quotes (`'...'`) for maximum compatibility with Bash.

#### Private Packagist (optional)

Travis sometimes fails to download all of the Composer dependencies from Github, causing builds to fail. The premium Private Packagist service makes this process much more robust, by mirorring dependencies onto its own servers.

This settingis optional and Composer will fall back to the original sources if a Private Packagist `COMPOSER_AUTH` key is not configured.

1. Name: `COMPOSER_AUTH`
1. Value: Copy from https://packagist.com/orgs/yourpackagistusername/tokens

#### Slack Notifications

1. Name: `SLACK_AUTH`
1. Value: Follow the instructions at https://docs.travis-ci.com/user/notifications/#Configuring-Slack-notifications to generate an encrypted key in the format `<account>:<token>`

---

## Notes

### Testing

PHPUnit is currently at version 6.1, but this project uses the Old Stable Release of 5.7 to work with PHP 5.6. This version is supported until February 2018, see https://phpunit.de/.

### Publishing

#### @since

PHP Doc's `@since` tag is used to track the generator version.

#### `readme.txt`

The headings correspond to the horizontal tabs that display on a plugin detail page on <http://wordpress.org/plugins>:

* Description
* Installation
* FAQ
* Screenshots
* Changelog

The remaining tabs are dynamically generated by WordPress.org:

* Stats
* Support
* Reviews
* Developers

[More about the readme](https://wordpress.org/plugins/developers/#readme)

### Translation

`.pot` files can be generated using the [WordPress i18n tools](https://developer.wordpress.org/themes/functionality/localization/#wordpress-i18n-tools)

---

## Respect is due

This plugin is the result of hours of research, including these great resources:

* [How to Build a WordPress Plugin](https://teamtreehouse.com/library/how-to-build-a-wordpress-plugin)
* [WordPress-Plugin-Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/)
* [Create A Custom Yeoman Generator in 4 Easy Steps](https://scotch.io/tutorials/create-a-custom-yeoman-generator-in-4-easy-steps)
* [Building a Yeoman Generator](https://webcake.co/building-a-yeoman-generator/)
* [JSONPlaceholder - Fake Online REST API for Testing and Prototyping](http://jsonplaceholder.typicode.com/)
