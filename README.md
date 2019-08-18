# DTRT WordPress Plugin Boilerplate Generator

[![GitHub tags](https://img.shields.io/github/tag/dotherightthing/generator-wpdtrt-plugin-boilerplate.svg)](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/tags) [![Build Status](https://travis-ci.org/dotherightthing/generator-wpdtrt-plugin-boilerplate.svg?branch=master)](https://travis-ci.org/dotherightthing/generator-wpdtrt-plugin-boilerplate) [![GitHub issues](https://img.shields.io/github/issues/dotherightthing/generator-wpdtrt-plugin-boilerplate.svg)](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/issues) [![GitHub wiki](https://img.shields.io/badge/documentation-wiki-lightgrey.svg)](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/wiki)

Generate a best-practice boilerplate for [WordPress](https://wordpress.org/) plugin development.

The generated plugin utilises the functionality packaged in the [DTRT WordPress Plugin Boilerplate](https://github.com/dotherightthing/wpdtrt-plugin-boilerplate) dependency.

***

## Installation

1. [Create a Git repo to store the code](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/wiki/Create-a-Git-repo-to-store-the-code)
2. [Install the generator dependencies](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/wiki/Install-the-generator-dependencies)
3. [Install the generator](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/wiki/Install-the-generator)
4. [Set up the required environmental variables](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/wiki/Set-up-environmental-variables)
5. [Use the generator to scaffold a custom plugin](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/wiki/Use-the-generator-to-scaffold-a-custom-plugin)
6. [Set up Travis CI](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/wiki/Set-up-Travis-CI)
7. Use the features of the [DTRT WordPress Plugin Boilerplate](https://github.com/dotherightthing/wpdtrt-plugin-boilerplate)

## Maintenance

This generator will need to be periodically updated as technologies change:

1. Update a previously generated plugin as necessary, see [Appendix: Generated plugins](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/wiki/Appendix:-Generated-plugins)
2. Copy relevant changes over to the [DTRT WordPress Plugin Boilerplate](https://github.com/dotherightthing/wpdtrt-plugin-boilerplate)
3. Build, test, version & release the updated [DTRT WordPress Plugin Boilerplate](https://github.com/dotherightthing/wpdtrt-plugin-boilerplate), see [Release an update](https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Workflows#release-an-update)
4. Copy relevant changes over to the *DTRT WordPress Plugin Boilerplate Generator*
5. Update the version of the [DTRT WordPress Plugin Boilerplate](https://github.com/dotherightthing/wpdtrt-plugin-boilerplate) required by the *DTRT WordPress Plugin Boilerplate Generator* in `./generators/app/templates/composer.json`:
  ```
  "require": {
    "dotherightthing/wpdtrt-plugin-boilerplate": "^1.5.6"
  },  
  ```
6. Build, test, version & release the updated *DTRT WordPress Plugin Boilerplate Generator*
7. Update previously generated plugins to reference the updated [DTRT WordPress Plugin Boilerplate](https://github.com/dotherightthing/wpdtrt-plugin-boilerplate) and *DTRT WordPress Plugin Boilerplate Generator*, see [Release an update](https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Workflows#release-an-update)

## Appendix

* [Unit testing](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/wiki/Appendix:-Unit-testing)
* [Publishing notes](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/wiki/Appendix:-Publishing-notes)
* [i18n](https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/wiki/Appendix:-i18n)

---

## Respect is due

This plugin is the result of countless hours of research, including these great resources:

* [How to Build a WordPress Plugin](https://teamtreehouse.com/library/how-to-build-a-wordpress-plugin)
* [WordPress-Plugin-Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/)
* [Create A Custom Yeoman Generator in 4 Easy Steps](https://scotch.io/tutorials/create-a-custom-yeoman-generator-in-4-easy-steps)
* [Building a Yeoman Generator](https://webcake.co/building-a-yeoman-generator/)
* [JSONPlaceholder - Fake Online REST API for Testing and Prototyping](http://jsonplaceholder.typicode.com/)
