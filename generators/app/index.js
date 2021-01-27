/**
 * File: generators/app/index.js
 *
 * Plugin generator.
 * Generates a plugin which utilizes dotherightthing/wpdtrt-plugin-boilerplate.
 */

const Generator = require('yeoman-generator');
const chalk = require('chalk');
const yosay = require('yosay');
const path = require('path');
const S = require('string');

module.exports = class extends Generator {
    /**
     * Method: initializing
     *
     * Sets up basic initialization,
     * such as setting properties names
     * based on information passed in by the user.
     *
     * See:
     * - <https://webcake.co/building-a-yeoman-generator/>
     */
    initializing() {
    // Set config defaults
    // Some defaults are also generated from these values
    // - see writing()

        const version = '0.8.13';
        const folderName = process.cwd().split(path.sep).pop();
        const folderNameFunctionSafe = S(folderName).replaceAll('-', '_').s;
        this.dtrt = false;

        // Use DTRT's defaults
        // Could this also be managed by .yo-rc.json?
        if (folderName.match('wpdtrt-')) {
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

        // generatorVersion aids backfilling of functionality
        // in generated plugins
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

        // name must match the folder name,
        // for WordPress to recognise the plugin
        this.config.set(
            'name',
            folderName
        );

        // human readable name
        this.config.set(
            'nameFriendly',
            S(folderName).humanize().titleCase()
                .replaceAll('Wpdtrt', 'DTRT').s
        );

        this.config.set(
            'nameSafe',
            folderNameFunctionSafe
        );

        // version matches sitehost container
        this.config.set(
            'phpVersion',
            this.dtrt ? '7.2.20' : ''
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
            '5.6'
        );
    }

    /**
     * Method: prompting
     *
     * Reserved for running questions by the user,
     * the answers to which can be used to
     * further define properties on the generator object
     *
     * Note:
     * - when changing these prompts, also update ./expect.sh
     *
     * See:
     * - <https://webcake.co/building-a-yeoman-generator/>
     *
     * @returns {*} A promise
     */
    prompting() {
        this.log(yosay(
            chalk.yellow(`DTRT WordPress Plugin Boilerplate Generator (${ this.config.get('generatorVersion') })`)
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
        // - <http://yeoman.io/authoring/user-interactions.html
        return this.prompt(prompts).then(props => {
            this.props = props;
        });
    }

    /**
     * Method: configuring
     *
     * Generally used for the initial configuration steps,
     * as well as auto-generating files
     * that you might find necessary and kind of a given,
     * like .gitignore, and .editorconfig as the docs suggest
     *
     * See:
     * - <https://webcake.co/building-a-yeoman-generator/>
     * - <https://stackoverflow.com/a/45427521/6850747>
     * - <https://stackoverflow.com/a/49809192/6850747>
     */
    configuring() {
        let defaultValues = this.config.getAll();
        let userValues = this.props;

        let mergedValues = {
            ...defaultValues,
            ...userValues
        };

        // set either takes a key and an associated value,
        // or an object hash of multiple keys/values.
        // http://yeoman.io/authoring/storage.html
        this.config.set(mergedValues);
    }

    /**
     * Method: default
     *
     * Not used.
     *
     * See:
     * - <https://webcake.co/building-a-yeoman-generator/>
     */
    // default() {}

    /**
     * Method: writing
     *
     * Actually writing the files based on data fields stored in the generator;
     * this can be done by either copying hard-coded files,
     * or passing data through EJS templates
     *
     * See:
     * - <https://webcake.co/building-a-yeoman-generator/>
     */
    writing() {
    // transformations

        this.transforms = [];

        this.transforms.authorUrl = `https://profiles.wordpress.org/'${this.config.get('authorWordPressName')}`;
        this.transforms.homepage = `https://github.com/${this.config.get('githubUserName')}/${this.config.get('name')}`;
        this.transforms.nameAdminMenu = S(this.config.get('nameFriendly'))
            .replaceAll('DTRT ', '').s;
        this.transforms.nameFriendlySafe = S(this.config.get('name'))
            .humanize().titleCase()
            .replaceAll('Wpdtrt', 'WPDTRT')
            .replaceAll(' ', '_').s;
        this.transforms.nameTemplate = S(this.config.get('name'))
            .replaceAll('wpdtrt-', '').s;
        /* eslint-disable */
        this.transforms.pluginKeywords = `["${this.props.tags.split(', ').join('", "')}", "wordpress-plugin"]`;
        /* eslint-enable */
        this.transforms.pluginUrlAdminMenu = `${S(this.props.authorAbbreviation).toLowerCase().s}-${S(this.config.get('nameAdminMenu')).toLowerCase().replaceAll(' ', '-').s}`;
        this.transforms.repositoryUrl = `git@github.com:${this.config.get('githubUserName')}/${this.config.get('name')}.git`;

        const userSettings = {
            authorEmail: this.props.authorEmail,
            authorSupportEmail: this.props.authorSupportEmail,
            authorName: this.props.authorName,
            authorUrl: this.transforms.authorUrl,
            authorAbbreviation: this.props.authorAbbreviation,
            authorWordPressName: this.props.authorWordPressName,
            constantStub: this.transforms.nameFriendlySafe.toUpperCase(),
            description: this.props.description,
            generatorVersion: this.config.get('generatorVersion'),
            githubUserName: this.props.githubUserName,
            homepage: this.transforms.homepage,
            name: this.config.get('name'),
            nameAdminMenu: this.transforms.nameAdminMenu,
            nameFriendly: this.props.nameFriendly,
            nameFriendlySafe: this.transforms.nameFriendlySafe,
            nameSafe: this.config.get('nameSafe'),
            nameTemplate: this.transforms.nameTemplate,
            phpVersion: this.props.phpVersion,
            pluginDonateUrl: this.props.donateUrl,
            pluginKeywords: this.transforms.pluginKeywords,
            pluginLicense: this.config.get('license'),
            pluginLicenseUrl: this.config.get('licenseUrl'),
            pluginTags: this.props.tags,
            pluginUrlAdminMenu: this.transforms.pluginUrlAdminMenu,
            defaultVersion: this.config.get('defaultVersion'),
            repositoryUrl: this.transforms.repositoryUrl,
            srcDir: process.cwd(),
            wpVersion: this.config.get('wpVersion')
        };

        // APP
        // --------

        // http://yeoman.io/authoring/file-system.html - Location contexts:
        // [dest] is defined as either the current working directory
        // or the closest parent folder containing a .yo-rc.json

        // Cypress.io

        this.fs.copyTpl(
            this.templatePath('cypress/plugins/index.js'),
            this.destinationPath('cypress/plugins/index.js'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('cypress/tsconfig.json'),
            this.destinationPath('cypress/tsconfig.json'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('cypress/integration/flows/wpdtrt-plugin-boilerplate.js'),
            this.destinationPath(`cypress/integration/flows/${userSettings.name}.js`),
            userSettings
        );

        // icons

        this.fs.copyTpl(
            this.templatePath('icons/icomoon/selection.json'),
            this.destinationPath('icons/icomoon/selection.json'),
            userSettings
        );

        // images

        this.fs.copy(
            this.templatePath('images/github-header.pxm'),
            this.destinationPath('images/github-header.pxm')
        );

        // js

        this.fs.copyTpl(
            this.templatePath('js/_frontend.js'),
            this.destinationPath('js/_frontend.js'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('js/frontend.txt'),
            this.destinationPath('js/frontend.txt'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('js/_backend.js'),
            this.destinationPath('js/_backend.js'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('js/backend.txt'),
            this.destinationPath('js/backend.txt'),
            userSettings
        );

        // i18n

        this.fs.copyTpl(
            this.templatePath('languages/wpdtrt-plugin-boilerplate.pot'),
            this.destinationPath(`languages/${userSettings.name}.pot`),
            userSettings
        );

        // scss

        this.fs.copyTpl(
            this.templatePath('scss/variables/_css.scss'),
            this.destinationPath('scss/variables/_css.scss'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('scss/variables/_scss.scss'),
            this.destinationPath('scss/variables/_scss.scss'),
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

        this.fs.copyTpl(
            this.templatePath('scss/wpdtrt-plugin-boilerplate-variables.scss'),
            this.destinationPath(`scss/${userSettings.name}-variables.scss`),
            userSettings
        );

        // src

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-plugin.php'),
            this.destinationPath(`src/class-${userSettings.name}-plugin.php`),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-rewrite.php'),
            this.destinationPath(`src/class-${userSettings.name}-rewrite.php`),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-shortcode.php'),
            this.destinationPath(`src/class-${userSettings.name}-shortcode.php`),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-taxonomy.php'),
            this.destinationPath(`src/class-${userSettings.name}-taxonomy.php`),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('src/class-wpdtrt-plugin-boilerplate-widget.php'),
            this.destinationPath(`src/class-${userSettings.name}-widget.php`),
            userSettings
        );

        // template-parts

        this.fs.copyTpl(
            this.templatePath('template-parts/wpdtrt-plugin-boilerplate/content.php'),
            this.destinationPath(`template-parts/${userSettings.name}/content-${userSettings.nameTemplate}.php`),
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
            this.destinationPath(`tests/test-${userSettings.name}.php`),
            userSettings
        );

        // root configuration files

        // Git

        this.fs.copy(
            this.templatePath('.gitignore'),
            this.destinationPath('.gitignore')
        );

        // Changelog

        this.fs.copyTpl(
            this.templatePath('CHANGELOG.md'),
            this.destinationPath('CHANGELOG.md'),
            userSettings
        );


        // Composer

        this.fs.copyTpl(
            this.templatePath('composer.json'),
            this.destinationPath('composer.json'),
            userSettings
        );

        // NPM

        this.fs.copyTpl(
            this.templatePath('package.json'),
            this.destinationPath('package.json'),
            userSettings
        );

        this.fs.copyTpl(
            this.templatePath('package-lock.json'),
            this.destinationPath('package-lock.json'),
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
            this.destinationPath(`${userSettings.name}.php`),
            userSettings
        );

        // IDE

        this.fs.copyTpl(
            this.templatePath('wpdtrt-plugin-boilerplate.code-workspace'),
            this.destinationPath(`${userSettings.name}.code-workspace`),
            userSettings
        );
    }

    /**
     * Method: conflicts
     *
     * Not used.
     *
     * See:
     * - <https://webcake.co/building-a-yeoman-generator/>
     */
    // conflicts() {}

    /**
     * Method: install
     *
     * Where you would either have Yeoman install dependencies – e.g. Bower -
     * or spawn child processes to install them yourself;
     * and you could take this opportunity to inject dependencies
     * into previously-written files as well
     * note: installDependencies() needs at least one of
     * 'npm', 'bower' or 'yarn' to run.
     *
     * See:
     * - <https://webcake.co/building-a-yeoman-generator/>
     * - <Re child_process.spawn: https://nodejs.org/api/child_process.html#child_process_child_process_spawn_command_args_options>
     * - <Composer hangs on Generating autoload files: https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/issues/5>
     * - <Re spawnCommandSync not working for CLI commands with arguments: https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate/issues/30>
     */
    install() {
        this.spawnCommandSync('npm', [
            'ci'
        ]);

        this.spawnCommandSync('npm', [
            'run',
            'lint',
            '--if-present'
        ]);

        this.spawnCommandSync('npm', [
            'run',
            'compile',
            '--if-present'
        ]);
    }

    /**
     * Method: end
     *
     * The cleanup process – removing any temp files that may have been written,
     * running any build or minification tasks, etc.
     *
     * See:
     * - <https://webcake.co/building-a-yeoman-generator/>
     */
    end() {
        this.log(yosay(
            `Install complete. Please read ${chalk.yellow('readme.txt')} and ${chalk.yellow('https://github.com/dotherightthing/wpdtrt-plugin-boilerplate#usage')}`
        ));
    }
};
