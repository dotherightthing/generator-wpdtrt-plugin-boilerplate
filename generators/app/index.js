/**
 * Plugin generator
 *
 * Generates a plugin which utilizes dotherightthing/wpdtrt-plugin-boilerplate
 *
 * @version     0.7.27
 */

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
        // Some defaults are also generated from these values
        // - see writing()

        var version = '0.7.27';
        var folderName = process.cwd().split(path.sep).pop();
        var folderNameFunctionSafe = S( folderName ).replaceAll('-','_').s;
        this.dtrt = false;

        // Use DTRT's defaults
        // Could this also be managed by .yo-rc.json?
        if ( folderName.match('wpdtrt-') ) {
            this.dtrt = true;
        }

        // Configuration options, in alphabetical order

        this.config.set(
            'authorAbbreviation',
            this.dtrt ? 'DTRT' : ''
        );

        this.config.set(
            'authorEmail',
            this.dtrt ? 'dev@dotherightthing.co.nz' : ''
        );

        this.config.set(
            'authorName',
            this.dtrt ? 'Dan Smith' : ''
        );

        this.config.set(
            'authorSupportEmail',
            this.dtrt ? 'support@dotherightthing.co.nz' : ''
        );

        this.config.set(
            'authorWordPressName',
            this.dtrt ? 'dotherightthingnz' : ''
        );

        this.config.set(
            'description',
            'Just another WordPress plugin'
        );

        this.config.set(
            'donateUrl',
            this.dtrt ? 'http://dotherightthing.co.nz' : ''
        );

        // generatorVersion aids backfilling of functionality in generated plugins
        this.config.set(
            'generatorVersion',
            version
        );

        this.config.set(
            'githubUserName',
            this.dtrt ? 'dotherightthing' : ''
        );

        this.config.set(
            'license',
            'GPLv2 or later'
        );

        this.config.set(
            'licenseUrl',
            'http://www.gnu.org/licenses/gpl-2.0.html'
        );

        // name must match the folder name, for WordPress to recognise the plugin
        this.config.set(
            'name',
            folderName
        );

        // human readable name
        this.config.set(
            'nameFriendly',
            S( folderName ).humanize().titleCase().replaceAll('Wpdtrt', 'DTRT').s
        );

        this.config.set(
            'nameSafe',
            folderNameFunctionSafe
        );

        this.config.set(
            'phpVersion',
            this.dtrt ? '5.6.30' : ''
        );

        // minimum semver version
        this.config.set(
            'defaultVersion',
            '0.1.0'
        );

        this.config.set(
            'tags',
            'foo, bar, baz'
        );

        this.config.set(
            'wpVersion',
            '4.9.5'
        );
    };

    /**
     * 2. prompting()
     * a method reserved for running questions by the user,
     * the answers to which can be used to further define properties on the generator object
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    prompting() {

        // https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/issues/68
        this.log(yosay(
          chalk.yellow('DTRT WordPress Plugin generator (' + this.config.get('generatorVersion') + ')' )
        ));

        const prompts = [
            {
                type: 'input',
                name: 'nameFriendly',
                message: 'Plugin name (spaces allowed)',
                default: this.config.get('nameFriendly')
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
                name: 'phpVersion',
                message: 'Software version (PHP)',
                default: this.config.get('phpVersion')
            },
            {
                type: 'input',
                name: 'authorName',
                message: 'Author names (first and last)',
                default: this.config.get('authorName')
            },
            {
                type: 'input',
                name: 'githubUserName',
                message: 'Author name (GitHub.com)',
                default: this.config.get('githubUserName')
            },
            {
                type: 'input',
                name: 'authorWordPressName',
                message: 'Author name (WordPress.org)',
                default: this.config.get('authorWordPressName')
            },
            {
                type: 'input',
                name: 'authorAbbreviation',
                message: 'Author abbreviation (no spaces)',
                default: this.config.get('authorAbbreviation')
            },
            {
                type: 'input',
                name: 'authorEmail',
                message: 'Author email (general)',
                default: this.config.get('authorEmail')
            },
            {
                type: 'input',
                name: 'authorSupportEmail',
                message: 'Author email (plugin support)',
                default: this.config.get('authorSupportEmail')
            },
            {
                type: 'input',
                name: 'donateUrl',
                message: 'Author donation URL',
                default: this.config.get('donateUrl')
            }
        ];

        // return the promise from your task
        // in order to wait for its completion before running the next one
        // @see http://yeoman.io/authoring/user-interactions.html
        return this.prompt(prompts).then(props => {
            this.props = props;
        });
    };

    /**
     * 3. configuring()
     * this method is generally used for the initial configuration steps,
     * as well as auto-generating files that you might find necessary and kind of a given,
     * like .gitignore, and .editorconfig as the docs suggest
     * {@link https://webcake.co/building-a-yeoman-generator/}
     * {@link https://stackoverflow.com/a/45427521/6850747}
     * {@link https://stackoverflow.com/a/49809192/6850747}
     */
    configuring() {
        let defaultValues = this.config.getAll();
        let userValues = this.props;

        let mergedValues = {
          ...defaultValues,
          ...userValues
        };

        // set either takes a key and an associated value, or an object hash of multiple keys/values.
        // http://yeoman.io/authoring/storage.html
        this.config.set(mergedValues);
    };

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
    };

    /**
     * 5. writing()
     * actually writing the files based on data fields stored in the generator;
     * this can be done by either copying hard-coded files,
     * or passing data through EJS templates
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    writing() {

        // transformations

        this.transforms = [];

        this.transforms.authorUrl = 'https://profiles.wordpress.org/' + this.config.get('authorWordPressName');
        this.transforms.homepage = 'https://github.com/' + this.config.get('githubUserName') + '/' + this.config.get('name');
        this.transforms.nameAdminMenu = S( this.config.get('nameFriendly') ).replaceAll('DTRT ', '').s;
        this.transforms.nameFriendlySafe = S( this.config.get('name') ).humanize().titleCase().replaceAll('Wpdtrt','WPDTRT').replaceAll(' ','_').s;
        this.transforms.nameTemplate = S( this.config.get('name') ).replaceAll('wpdtrt-', '').s;
        this.transforms.pluginKeywords = '["' + this.props.tags.split(', ').join('", "') + '"]';
        this.transforms.pluginUrlAdminMenu = S(this.props.authorAbbreviation).toLowerCase().s + '-' + S( this.config.get('nameAdminMenu') ).toLowerCase().replaceAll(' ','-').s;
        this.transforms.repositoryUrl = 'git@github.com:' + this.config.get('githubUserName') + '/' + this.config.get('name') + '.git';

        var userSettings = {
            authorEmail:                    this.props.authorEmail,
            authorSupportEmail:             this.props.authorSupportEmail,
            authorName:                     this.props.authorName,
            authorUrl:                      this.transforms.authorUrl,
            authorAbbreviation:             this.props.authorAbbreviation,
            authorWordPressName:            this.props.authorWordPressName,
            constantStub:                   this.transforms.nameFriendlySafe.toUpperCase(),
            description:                    this.props.description,
            generatorVersion:               this.config.get('generatorVersion'),
            githubUserName:                 this.props.githubUserName,
            homepage:                       this.transforms.homepage,
            name:                           this.config.get('name'),
            nameAdminMenu:                  this.transforms.nameAdminMenu,
            nameFriendly:                   this.props.nameFriendly,
            nameFriendlySafe:               this.transforms.nameFriendlySafe,
            nameSafe:                       this.config.get('nameSafe'),
            nameTemplate:                   this.transforms.nameTemplate,
            phpVersion:                     this.props.phpVersion,
            pluginDonateUrl:                this.props.donateUrl,
            pluginKeywords:                 this.transforms.pluginKeywords,
            pluginLicense:                  this.config.get('license'),
            pluginLicenseUrl:               this.config.get('licenseUrl'),
            pluginTags:                     this.props.tags,
            pluginUrlAdminMenu:             this.transforms.pluginUrlAdminMenu,
            defaultVersion:                 this.config.get('defaultVersion'),
            repositoryUrl:                  this.transforms.repositoryUrl,
            srcDir:                         process.cwd(),
            wpVersion:                      this.config.get('wpVersion')
        };

        // APP
        // --------

        // http://yeoman.io/authoring/file-system.html - Location contexts:
        // [dest] is defined as either the current working directory
        // or the closest parent folder containing a .yo-rc.json

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
            this.destinationPath('languages/' + userSettings.name + '.pot'),
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

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-plugin.php'),
            this.destinationPath('src/class-' + userSettings.name + '-plugin.php'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-rewrite.php'),
            this.destinationPath('src/class-' + userSettings.name + '-rewrite.php'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-shortcode.php'),
            this.destinationPath('src/class-' + userSettings.name + '-shortcode.php'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-taxonomy.php'),
            this.destinationPath('src/class-' + userSettings.name + '-taxonomy.php'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-widget.php'),
            this.destinationPath('src/class-' + userSettings.name + '-widget.php'),
            userSettings
        );

        // template-parts

        this.fs.copyTpl(
            this.templatePath('template-parts/wpdtrt-plugin-boilerplate/content.php'),
            this.destinationPath('template-parts/' + userSettings.name + '/content-' + userSettings.nameTemplate + '.php'),
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
            this.destinationPath('tests/test-' + userSettings.name + '.php'),
            userSettings
        );

        // root configuration files

        // ESLint

        this.fs.copy(
            this.templatePath('.eslintrc'),
            this.destinationPath('.eslintrc')
        );

        // Git

        this.fs.copy(
            this.templatePath('.gitignore'),
            this.destinationPath('.gitignore')
        );


        // PHP Code Sniffer exclusions

        this.fs.copy(
            this.templatePath('phpcs.xml'),
            this.destinationPath('phpcs.xml')
        );

        // PHPDoc config

        this.fs.copyTpl(
            this.templatePath('phpdoc-plugin.xml'),
            this.destinationPath('phpdoc-plugin.xml'),
            userSettings
        );

        // SCSS Lint config

        this.fs.copy(
            this.templatePath('.sass-lint.yml'),
            this.destinationPath('.sass-lint.yml')
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

        // Yarn / NPM

        this.fs.copyTpl(
            this.templatePath('package.json'),
            this.destinationPath('package.json'),
            userSettings
        );

        // documentation

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
            this.destinationPath(userSettings.name + '.php'),
            userSettings
        );

        // Sublime Text
        
        this.fs.copyTpl(
            this.templatePath('wpdtrt-plugin-boilerplate.sublime-project'),
            this.destinationPath(userSettings.name + '.sublime-project'),
            userSettings
        );

    };

    /**
     * 6. conflicts()
     * the docs say ‘Where conflicts are handled (used internally)’.
     * If it’s an internal-method to the generator class I’m not sure why it’s exposed to developers,
     * and I have yet to see it used in any generator that I’ve researched
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    conflicts() {
        //
    };

    /**
     * 7. install()
     * where you would either have Yeoman install dependencies – e.g. Bower -
     * or spawn child processes to install them yourself;
     * and you could take this opportunity to inject dependencies
     * into previously-written files as well
     * note: installDependencies needs at least one of `npm`, `bower` or `yarn` to run.
     * {@link https://webcake.co/building-a-yeoman-generator/}
     * @see https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/issues/5
     * @see https://stackoverflow.com/a/29834006/6850747
     * @see https://nodejs.org/api/child_process.html#child_process_child_process_spawn_command_args_options
     * @todo https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/issues/30
     */
    install() {

        // Expose the existing Travis OAuth token to Composer
        this.spawnCommandSync('composer', [
            'config',
            '--global',
            'github-oauth.github.com',
            process.env.GH_TOKEN
        ]);

        // composer is installed by travis
        // composer reads the generated composer.json
        // this installs the boilerplate class
        this.spawnCommandSync('composer', [
            'install',
            '--prefer-dist',
            '--no-interaction',
            '--no-suggest',
            '--verbose'
        ]);

        // enable support for yarn workspaces (experimental)
        // this allows us to install the dependencies of wpdtrt-plugin-boilerplate (autoprefixer etc)
        // as well as those of the generated plugin (gulp)
        // see ./package.json
        this.spawnCommandSync('yarn', [
            'config',
            'set',
            'workspaces-experimental',
            'true'
        ]);

        // install node dependencies
        // yarn reads the generated package.json & yarn.lock
        // this installs the dev dependency of Gulp
        // which is used to run the wpdtrt-plugin-boilerplate gulpfile, below
        //
        // note: installDependencies runs too late, causing gulp install to fail
        // this.installDependencies({
        //     npm: false,
        //     bower: false,
        //     yarn: true
        // });
        this.spawnCommandSync('yarn', [
            'install',
            '--non-interactive'
        ]);

        // gulp-cli is installed by travis
        // gulp is installed with the generator
        // gulp reads ./vendor/dotherightthing/wpdtrt-plugin-boilerplate/gulpfile.js
        // yarn run is equivalent to npm run
        this.spawnCommandSync('yarn', [
            'run',
            'build'
        ]);
    };

    /**
     * 8. end()
     * the cleanup process – removing any temp files that may have been written,
     * running any build or minification tasks, etc.
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    end() {

        this.log(yosay(
            'Install complete. Please read ' + chalk.yellow('readme.txt') + ' and ' + chalk.yellow('https://github.com/dotherightthing/wpdtrt-plugin-boilerplate#usage')
        ));
    };

};
