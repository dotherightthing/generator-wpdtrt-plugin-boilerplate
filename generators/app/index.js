/**
 * Plugin generator
 *
 * Generates a plugin which utilizes dotherightthing/wpdtrt-plugin
 *
 * @version     0.7.7
 */

/*jslint node: true, esversion:6 */

'use strict';
const Generator = require('yeoman-generator');
const chalk = require('chalk');
const yosay = require('yosay');
const path = require('path');
const S = require('string');

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

        var prefix = '';

        // generatorVersion aids backfilling of functionality
        // in generated plugins
        this.config.set(
            'generatorVersion',
            '0.7.7'
        );

        // name must match the folder name, for WordPress to recognise the plugin
        this.config.set(
            'name',
            process.cwd().split(path.sep).pop() // get plugin name from parent folder
        );

        if ( this.config.get('name').match('wpdtrt') ) {
            prefix = 'wpdtrt-';
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
            'content-' + S( this.config.get('name') ).replaceAll('wpdtrt-', '').s
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
            'githubUserName',
            'dotherightthing'
        );

        this.config.set(
            'homepage',
            ( 'https://github.com/' + this.config.get('githubUserName') + '/' + this.config.get('name') )
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
            '4.9.5'
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
            'authorSupportEmail',
            'support@dotherightthing.co.nz'
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
            ( 'git@github.com:' + this.config.get('githubUserName') + '/' + this.config.get('name') + '.git' )
        );

        this.config.set(
            'travisTestDatabaseName',
            this.config.get('nameSafe') + 'Test'
        );

        this.config.set(
            'travisTestDatabaseUserName',
            'root'
        );

        this.config.set(
            'travisTestDatabasePassword',
            '""'
        );

        this.config.set(
            'localTestDatabaseName',
            this.config.get('nameSafe') + 'Test'
        );

        this.config.set(
            'localTestDatabaseUserName',
            ''
        );

        this.config.set(
            'localTestDatabasePassword',
            ''
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

        // https://github.com/dotherightthing/wpdtrt-plugin/issues/68
        this.log(yosay(
          'Before we begin, please run ' + chalk.yellow('source ~/.bash_profile')
        ));

        const prompts = [
            {
                type: 'input',
                name: 'generatorVersion',
                message: 'Generator version',
                default: this.config.get('generatorVersion')
            },
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
                name: 'nameTemplate',
                message: 'Template name',
                default: this.config.get('nameTemplate')
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
                name: 'authorAbbreviation',
                message: 'Your abbreviated name',
                default: this.config.get('authorAbbreviation')
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
                name: 'authorSupportEmail',
                message: 'Email address for plugin support enquiries',
                default: this.config.get('authorSupportEmail')
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
            },
            {
                type: 'input',
                name: 'githubUserName',
                message: 'Github Vendor Name',
                default: this.config.get('githubUserName')
            },    
            {
                type: 'input',
                name: 'localTestDatabaseName',
                message: 'Database name for WordPress Unit tests (local dev)',
                default: this.config.get('localTestDatabaseName')
            },
            {
                type: 'input',
                name: 'localTestDatabaseUserName',
                message: 'Database user for WordPress Unit tests (local dev)',
                default: this.config.get('localTestDatabaseUserName')
            },
            {
                type: 'input',
                name: 'localTestDatabasePassword',
                message: 'Database password for WordPress Unit tests (local dev)',
                default: this.config.get('localTestDatabasePassword')
            },
            {
                type: 'input',
                name: 'travisTestDatabaseName',
                message: 'Database name for WordPress Unit tests (Travis CI)',
                default: this.config.get('travisTestDatabaseName')
            },
            {
                type: 'input',
                name: 'travisTestDatabaseUserName',
                message: 'Database user for WordPress Unit tests (Travis CI)',
                default: this.config.get('travisTestDatabaseUserName')
            },
            {
                type: 'input',
                name: 'travisTestDatabasePassword',
                message: 'Database password for WordPress Unit tests (Travis CI)',
                default: this.config.get('travisTestDatabasePassword')
            }
        ];

        // return the promise from your task
        // in order to wait for its completion before running the next one
        // @see http://yeoman.io/authoring/user-interactions.html
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
            authorEmail:                    this.props.authorEmail,
            authorSupportEmail:             this.props.authorSupportEmail,
            authorName:                     this.props.authorName,
            authorUrl:                      this.props.authorUrl,
            authorAbbreviation:             this.props.authorAbbreviation,
            authorWordPressName:            this.props.authorWordPressName,
            constantStub:                   this.props.nameFriendlySafe.toUpperCase(),
            description:                    this.props.description,
            generatorVersion:               this.props.generatorVersion,
            githubUserName:                 this.props.githubUserName,
            homepage:                       this.props.homepage,
            localTestDatabaseName:          this.props.localTestDatabaseName,
            localTestDatabaseUserName:      this.props.localTestDatabaseUserName,
            localTestDatabasePassword:      this.props.localTestDatabasePassword,
            name:                           this.props.name,
            nameAdminMenu:                  this.props.nameAdminMenu,
            nameFriendly:                   this.props.nameFriendly,
            nameFriendlySafe:               this.props.nameFriendlySafe,
            nameSafe:                       this.props.nameSafe,
            nameTemplate:                   this.props.nameTemplate,
            phpVersion:                     this.props.phpVersion,
            pluginDonateUrl:                this.props.donateUrl,
            pluginKeywords:                 '["' + this.props.tags.split(', ').join('", "') + '"]',
            pluginLicense:                  this.props.license,
            pluginLicenseUrl:               this.props.licenseUrl,
            pluginTags:                     this.props.tags,
            pluginUrl:                      this.props.homepage,
            pluginUrlAdminMenu:             this.props.urlAdminMenu,
            repositoryType:                 this.props.repositoryType,
            repositoryUrl:                  this.props.repositoryUrl,
            srcDir:                         process.cwd(),
            travisTestDatabaseName:         this.props.travisTestDatabaseName,
            travisTestDatabaseUserName:     this.props.travisTestDatabaseUserName,
            travisTestDatabasePassword:     this.props.travisTestDatabasePassword,
            wpVersion:                      this.props.wpVersion
        };

        // APP
        // --------

        // http://yeoman.io/authoring/file-system.html - Location contexts:
        // [dest] is defined as either the current working directory
        // or the closest parent folder containing a .yo-rc.json


        // bin - unit testing

        this.fs.copy(
            this.templatePath('bin/install-wp-tests.sh'),
            this.destinationPath('bin/install-wp-tests.sh')
        );

        // images

        this.fs.copy(
            this.templatePath('images/github-header.pxm'),
            this.destinationPath('images/github-header.pxm')
        );

        // js

        this.fs.copyTpl(
            this.templatePath('js/frontend.js'),
            this.destinationPath('js/frontend.js'),
            userSettings
        );

        // i18n

        this.fs.copyTpl(
            this.templatePath('languages/wpdtrt-plugin-boilerplate.pot'),
            this.destinationPath('languages/' + this.props.name + '.pot'),
            userSettings
        );

        // scss

        this.fs.copyTpl(
            this.templatePath('scss/_extends.scss'),
            this.destinationPath('scss/_extends.scss'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('scss/_variables.scss'),
            this.destinationPath('scss/_variables.scss'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('scss/backend.scss'),
            this.destinationPath('scss/backend.scss'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('scss/frontend.scss'),
            this.destinationPath('scss/frontend.scss'),
            userSettings
        );

        // src

        this.fs.copy(
            this.templatePath('src/index.php'),
            this.destinationPath('src/index.php')
        );

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-plugin.php'),
            this.destinationPath('src/class-' + this.props.name + '-plugin.php'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-widgets.php'),
            this.destinationPath('src/class-' + this.props.name + '-widgets.php'),
            userSettings
        );

        // template-parts

        this.fs.copyTpl(
            this.templatePath('template-parts/wpdtrt-plugin-boilerplate/content.php'),
            this.destinationPath('template-parts/' + this.props.name + '/' + this.props.nameTemplate + '.php'),
            userSettings
        );

        // tests

        this.fs.copyTpl(
            this.templatePath('tests/bootstrap.php'),
            this.destinationPath('tests/bootstrap.php'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('tests/test-wpdtrt-plugin-boilerplate.php'),
            this.destinationPath('tests/test-' + this.props.name + '.php'),
            userSettings
        );

        // root configuration files

        // Bower

        this.fs.copy(
            this.templatePath('.bowerrc'),
            this.destinationPath('.bowerrc')
        );

        this.fs.copyTpl(
            this.templatePath('bower.json'),
            this.destinationPath('bower.json'),
            userSettings
        );

        // Git

        this.fs.copy(
            this.templatePath('.gitignore'),
            this.destinationPath('.gitignore')
        );

        // Travis CI (Github build)

        this.fs.copyTpl(
            this.templatePath('.travis.yml'),
            this.destinationPath('.travis.yml'),
            userSettings
        );

        // Composer

        this.fs.copyTpl(
            this.templatePath('composer.json'),
            this.destinationPath('composer.json'),
            userSettings
        );

        // Gulp / NPM

        this.fs.copyTpl(
            this.templatePath('gulpfile.js'),
            this.destinationPath('gulpfile.js'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('package.json'),
            this.destinationPath('package.json'),
            userSettings
        );

        // root security

        this.fs.copy(
            this.templatePath('index.php'),
            this.destinationPath('index.php')
        );

        // PHPUnit testing

        this.fs.copy(
            this.templatePath('phpunit.xml.dist'),
            this.destinationPath('phpunit.xml.dist')
        );

        // documentation

        this.fs.copyTpl(
            this.templatePath('phpdoc.dist.xml'),
            this.destinationPath('phpdoc.dist.xml'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('README.md'),
            this.destinationPath('README.md'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('readme.txt'),
            this.destinationPath('readme.txt'),
            userSettings
        );

        // app

        this.fs.copyTpl(
            this.templatePath('uninstall.php'),
            this.destinationPath('uninstall.php'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('wpdtrt-plugin-boilerplate.php'),
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
     * note: installDependencies needs at least one of `npm`, `bower` or `yarn` to run.
     * {@link https://webcake.co/building-a-yeoman-generator/}
     * @see https://github.com/dotherightthing/generator-wp-plugin-boilerplate/issues/5
     * @see https://stackoverflow.com/a/29834006/6850747
     * @see https://nodejs.org/api/child_process.html#child_process_child_process_spawn_command_args_options
     * @todo https://github.com/dotherightthing/generator-wp-plugin-boilerplate/issues/30
     */
    install() {
        this.installDependencies({
            npm: true,
            bower: false,
            yarn: false
        });

        // composer is installed by travis
        // loads parent plugin class, which in turn runs a composer install via gulpfile.js
        this.spawnCommandSync('composer', [
            'install',
            '--prefer-dist',
            '--no-interaction'
        ]);

        // node is installed by travis
        this.spawnCommandSync('npm', [
            'install',
            './vendor/dotherightthing/wpdtrt-plugin/',
            '--prefix',
            './vendor/dotherightthing/wpdtrt-plugin/'
        ]);

        // test setup is run by travis on before_script
        this.spawnCommandSync('bash', [
            'bin/install-wp-tests.sh',
            this.props.localTestDatabaseName,
            this.props.localTestDatabaseUserName,
            this.props.localTestDatabasePassword,
            '127.0.0.1',
            this.props.wpVersion
        ]);

        // gulp-cli is installed by travis
        // gulp is installed with the generator
        this.spawnCommandSync('gulp', [
            'install',
            '--gulpfile',
            './vendor/dotherightthing/wpdtrt-plugin/gulpfile.js',
            '--cwd',
            './'
        ]);
    }

    /**
     * 8. end()
     * the cleanup process – removing any temp files that may have been written,
     * running any build or minification tasks, etc.
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    end() {

        this.log(yosay(
          'Thanks for installing the ' + chalk.red('DTRT WordPress Plugin boilerplate')
        ));

        this.log(yosay(
            'Please read readme.txt and https://github.com/dotherightthing/wpdtrt-plugin#set-up-a-new-plugin'
        ));
    }

};
