/*jslint node: true, esversion:6 */

'use strict';
const Generator = require('yeoman-generator');
const chalk = require('chalk');
const yosay = require('yosay');
const path = require('path');
const S = require('string');
const open = require("open");
const pjson = require('../../package.json');

module.exports = class extends Generator {

    /**
     * 1. initializing()
     * a method for setting up basic initialization,
     * such as setting some properties names on your generator
     * based on information passed in by the user
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    initializing() {

        // Set config defaults

        // name must match the folder name, for WordPress to recognise the plugin
        this.config.set(
            'name',
            process.cwd().split(path.sep).pop() // get plugin name from parent folder
        );

        if ( this.config.get('name').match('wpdtrt') ) {
            var prefix = 'wpdtrt-';
        }

        // nameSafe is used in PHP functions, so is based on name
        this.config.set(
            'nameSafe',
            S( this.config.get('name') ).replaceAll('-','_').s
        );

        // human readable name
        this.config.set(
            'nameFriendly',
            S( this.config.get('name') ).humanize().titleCase().replaceAll('Wpdtrt', 'DTRT').s
        );

        // nameFriendlySafe is used in PHP classes, so is based on nameFriendly
        this.config.set(
            'nameFriendlySafe',
            S( this.config.get('name') ).humanize().titleCase().replaceAll('Wpdtrt','WPDTRT').replaceAll(' ','_').s
        );

        this.config.set(
            'nameAdminMenu',
            S( this.config.get('nameFriendly') ).replaceAll('DTRT ', '').s
        );

        this.config.set(
            'nameTemplate',
            S( this.config.get('name') ).replaceAll('wpdtrt- ', '').s
        );

        this.config.set(
            'urlAdminMenu',
            prefix + S( this.config.get('nameAdminMenu') ).toLowerCase().replaceAll(' ','-').s
        );

        this.config.set(
            'description',
            'Just another WordPress plugin'
        );

        this.config.set(
            'tags',
            'boilerplate, foo, bar, baz'
        );

        this.config.set(
            'homepage',
            ( 'https://github.com/dotherightthing/' + this.config.get('name') )
        );

        this.config.set(
            'license',
            'GPLv2 or later'
        );

        this.config.set(
            'licenseUrl',
            'http://www.gnu.org/licenses/gpl-2.0.html'
        );

        this.config.set(
            'donateUrl',
            'http://dotherightthing.co.nz'
        );

        this.config.set(
            'wpVersion',
            '4.8.2'
        );

        this.config.set(
            'phpVersion',
            '5.6.30'
        );

        this.config.set(
            'authorName',
            'Dan Smith'
        );

        this.config.set(
            'authorWordPressName',
            'dotherightthingnz'
        );

        this.config.set(
            'authorAbbreviation',
            'DTRT'
        );

        this.config.set(
            'authorEmail',
            'dev@dotherightthing.co.nz'
        );

        this.config.set(
            'authorUrl',
            'https://profiles.wordpress.org/dotherightthingnz'
        );

        this.config.set(
            'repositoryType',
            'git'
        );

        this.config.set(
            'repositoryUrl',
            ( 'git@github.com:dotherightthing/' + this.config.get('name') + '.git' )
        );

        // version is based on the current version of the generator
        // to allow backfilling of functionality added in spin-off plugins
        this.config.set(
            'version',
            '0.0.1' // pjson.version
        );
    }

    /**
     * 2. prompting()
     * a method reserved for running questions by the user,
     * the answers to which can be used to further define properties on the generator object
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    prompting() {

        this.log(yosay(
          'Welcome to the ' + chalk.red('WordPress Plugin boilerplate') + ' generator!'
        ));

        const prompts = [
            {
                type: 'input',
                name: 'name',
                message: 'Plugin name (file safe)',
                default: this.config.get('name')
            },
            {
                type: 'input',
                name: 'nameSafe',
                message: 'Plugin name (function safe)',
                default: this.config.get('nameSafe')
            },
            {
                type: 'input',
                name: 'nameFriendly',
                message: 'Plugin name (friendly)',
                default: this.config.get('nameFriendly')
            },
            {
                type: 'input',
                name: 'nameFriendlySafe',
                message: 'Plugin name (friendly & function safe)',
                default: this.config.get('nameFriendlySafe')
            },
            {
                type: 'input',
                name: 'nameAdminMenu',
                message: 'Plugin name (admin menu)',
                default: this.config.get('nameAdminMenu')
            },
            {
                type: 'input',
                name: 'urlAdminMenu',
                message: 'Plugin URL (admin menu)',
                default: this.config.get('urlAdminMenu')
            },
            {
                type: 'input',
                name: 'description',
                message: 'Plugin description',
                default: this.config.get('description')
            },
            {
                type: 'input',
                name: 'tags',
                message: 'Plugin tags (<=12, !wordpress, !wp)',
                default: this.config.get('tags')
            },
            {
                type: 'input',
                name: 'homepage',
                message: 'Plugin URL',
                default: this.config.get('homepage')
            },
            {
                type: 'input',
                name: 'license',
                message: 'Plugin license',
                default: this.config.get('license')
            },
            {
                type: 'input',
                name: 'licenseUrl',
                message: 'Plugin license URL',
                default: this.config.get('licenseUrl')
            },
            {
                type: 'input',
                name: 'donateUrl',
                message: 'Plugin donation URL',
                default: this.config.get('donateUrl')
            },
            {
                type: 'input',
                name: 'version',
                message: 'Plugin version',
                default: this.config.get('version')
            },
            {
                type: 'input',
                name: 'wpVersion',
                message: 'WordPress version',
                default: this.config.get('wpVersion')
            },
            {
                type: 'input',
                name: 'phpVersion',
                message: 'PHP version',
                default: this.config.get('phpVersion')
            },
            {
                type: 'input',
                name: 'authorName',
                message: 'Your first and last names',
                default: this.config.get('authorName')
            },
            {
                type: 'input',
                name: 'authorWordPressName',
                message: 'Your WordPress.org username',
                default: this.config.get('authorWordPressName')
            },
            {
                type: 'input',
                name: 'authorEmail',
                message: 'Your email address',
                default: this.config.get('authorEmail')
            },
            {
                type: 'input',
                name: 'authorUrl',
                message: 'Author URL',
                default: this.config.get('authorUrl')
            },
            {
                type: 'input',
                name: 'repositoryType',
                message: 'Version control system (git/svn)',
                default: this.config.get('repositoryType')
            },
            {
                type: 'input',
                name: 'repositoryUrl',
                message: 'Repository URL',
                default: this.config.get('repositoryUrl')
            }
        ];

        return this.prompt(prompts).then(props => {
            this.props = props;
        });
    }

    /**
     * 3. configuring()
     * this method is generally used for the initial configuration steps,
     * as well as auto-generating files that you might find necessary and kind of a given,
     * like .gitignore, and .editorconfig as the docs suggest
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    configuring() {
        this.config.set(this.props);
    }

    /**
     * 4. default()
     * if no specific method of the base generator class is extended,
     * any functionality added to the generator will fall into the default method.
     * I have yet to find a use for it, since when I write generators
     * they use the other available methods instead
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    default() {
        //
    }

    /**
     * 5. writing()
     * actually writing the files based on data fields stored in the generator;
     * this can be done by either copying hard-coded files,
     * or passing data through EJS templates
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    writing() {

        var userSettings = {
            authorEmail:            this.props.authorEmail,
            authorName:             this.props.authorName,
            authorUrl:              this.props.authorUrl,
            authorAbbreviation:     this.props.authorAbbreviation,
            authorWordPressName:    this.props.authorWordPressName,
            description:            this.props.description,
            homepage:               this.props.homepage,
            name:                   this.props.name,
            nameAdminMenu:          this.props.nameAdminMenu,
            nameFriendly:           this.props.nameFriendly,
            nameFriendlySafe:       this.props.nameFriendlySafe,
            nameSafe:               this.props.nameSafe,
            nameTemplate:           this.props.nameTemplate,
            phpVersion:             this.props.phpVersion,
            pluginDonateUrl:        this.props.donateUrl,
            pluginLicense:          this.props.license,
            pluginLicenseUrl:       this.props.licenseUrl,
            pluginTags:             this.props.tags,
            pluginUrl:              this.props.homepage,
            pluginUrlAdminMenu:     this.props.urlAdminMenu,
            repositoryType:         this.props.repositoryType,
            repositoryUrl:          this.props.repositoryUrl,
            srcDir:                 process.cwd(),
            wpVersion:              this.props.wpVersion,
            version:                this.props.version
        };

        userSettings.constantStub = this.props.nameFriendlySafe.toUpperCase(),

        // APP
        // --------

        // http://yeoman.io/authoring/file-system.html - Location contexts:
        // [dest] is defined as either the current working directory
        // or the closest parent folder containing a .yo-rc.json

        // js

        this.fs.copyTpl(
            this.templatePath('js/_frontend.js'),
            this.destinationPath('js/frontend.js'),
            userSettings
        );

        // scss

        this.fs.copyTpl(
            this.templatePath('scss/_backend.scss'),
            this.destinationPath('scss/backend.scss'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('scss/_frontend.scss'),
            this.destinationPath('scss/frontend.scss'),
            userSettings
        );

        // src

        this.fs.copyTpl(
            this.templatePath('src/_class-wpdtrt-plugin-boilerplate-plugin.php'),
            this.destinationPath('src/class-' + this.props.name + '-plugin.php'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('src/_class-wpdtrt-plugin-boilerplate-widgets.php'),
            this.destinationPath('src/class-' + this.props.name + '-widgets.php'),
            userSettings
        );

        // template-parts

        this.fs.copyTpl(
            this.templatePath('template-parts/_wpdtrt-plugin-boilerplate/_content.php'),
            this.destinationPath('template-parts/' + this.props.name + '/content-' + this.props.nameTemplate + '.php'),
            userSettings
        );

        // root configuration files

        // Bower

        this.fs.copy(
            this.templatePath('_.bowerrc'),
            this.destinationPath('.bowerrc')
        );

        this.fs.copyTpl(
            this.templatePath('_bower.json'),
            this.destinationPath('bower.json'),
            userSettings
        );

        // Git

        this.fs.copy(
            this.templatePath('_.gitignore'),
            this.destinationPath('.gitignore')
        );

        // Composer

        this.fs.copyTpl(
            this.templatePath('_composer.json'),
            this.destinationPath('composer.json'),
            userSettings
        );

        // root security

        this.fs.copy(
            this.templatePath('_index.php'),
            this.destinationPath('index.php')
        );

        // documentation

        this.fs.copyTpl(
            this.templatePath('_readme.txt'),
            this.destinationPath('readme.txt'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('_README.md'),
            this.destinationPath('README.md'),
            userSettings
        );

        // app

        this.fs.copyTpl(
            this.templatePath('_uninstall.php'),
            this.destinationPath('uninstall.php'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('_wpdtrt-plugin-boilerplate.php'),
            this.destinationPath(this.props.name + '.php'),
            userSettings
        );

    }

    /**
     * 6. conflicts()
     * the docs say ‘Where conflicts are handled (used internally)’.
     * If it’s an internal-method to the generator class I’m not sure why it’s exposed to developers,
     * and I have yet to see it used in any generator that I’ve researched
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    conflicts() {
        //
    }

    /**
     * 7. install()
     * where you would either have Yeoman install dependencies – e.g. Bower -
     * or spawn child processes to install them yourself;
     * and you could take this opportunity to inject dependencies
     * into previously-written files as well
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    install() {
        this.installDependencies({
            npm: false,
            bower: true,
            yarn: false
        });

        // https://github.com/dotherightthing/generator-wp-plugin-boilerplate/issues/5
        this.spawnCommand('composer', ['install']);
    }

    /**
     * 8. end()
     * the cleanup process – removing any temp files that may have been written,
     * running any build or minification tasks, etc.
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    end() {

        this.log(yosay(
          'Thanks for installing the ' + chalk.red('WordPress Plugin boilerplate') + '. Enjoy!'
        ));

        open("readme.txt");
    }

};
