/*jslint node: true, esversion:6 */

'use strict';
const Generator = require('yeoman-generator');
const chalk = require('chalk');
const yosay = require('yosay');
const path = require('path');
const S = require('string');
const open = require("open");

module.exports = class extends Generator {

    /**
     * 1. initializing()
     * a method for setting up basic initialization,
     * such as setting some properties names on your generator
     * based on information passed in by the user
     * {@link https://webcake.co/building-a-yeoman-generator/}
     */
    initializing() {

        this.config.set(
            'name',
            process.cwd().split(path.sep).pop() // get plugin name from parent folder
        );

        this.config.set(
            'nameSafe',
            S( this.config.get('name') ).replaceAll('-','_').s
        );

        this.config.set(
            'nameFriendly',
            S( this.config.get('name') ).humanize().titleCase().s
        );

        this.config.set(
            'nameFriendlySafe',
            S( this.config.get('name') ).humanize().titleCase().replaceAll(' ','_').s
        );

        this.config.set(
            'nameAdminMenu',
            this.config.get('nameFriendly')
        );

        this.config.set(
            'urlAdminMenu',
            S( this.config.get('nameAdminMenu') ).toLowerCase().replaceAll(' ','-').s
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
                message: 'Plugin tags',
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
                message: 'Plugin License',
                default: this.config.get('license')
            },
            {
                type: 'input',
                name: 'licenseUrl',
                message: 'Plugin License URL',
                default: this.config.get('licenseUrl')
            },
            {
                type: 'input',
                name: 'donateUrl',
                message: 'Plugin Donate URL',
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
                message: 'Repository Url',
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
        // Copy the configuration files

        // Security

        this.fs.copy(
            this.templatePath('_index.php'),
            this.destinationPath('index.php')
        );

        // Bower

        this.fs.copy(
            this.templatePath('_.bowerrc'),
            this.destinationPath('.bowerrc')
        );

        this.fs.copyTpl(
            this.templatePath('_bower.json'),
            this.destinationPath('bower.json'), {
                name:           this.props.name,
                description:    this.props.description,
                authorName:     this.props.authorName,
                authorEmail:    this.props.authorEmail,
                authorUrl:      this.props.authorUrl,
                homepage:       this.props.homepage
            }
        );

        // Git
        this.fs.copy(
            this.templatePath('_.gitignore'),
            this.destinationPath('.gitignore')
        );

        // Composer

        this.fs.copy(
            this.templatePath('_composer.json'),
            this.destinationPath('composer.json')
        );

        this.fs.copy(
            this.templatePath('_composer.lock'),
            this.destinationPath('composer.lock')
        );

        // Gulp

        this.fs.copy(
            this.templatePath('_gulpfile.js'),
            this.destinationPath('gulpfile.js')
        );

        // NPM
        this.fs.copyTpl(
            this.templatePath('_package.json'),
            this.destinationPath('package.json'), {
                name:                   this.props.name,
                description:            this.props.description,
                repositoryType:         this.props.repositoryType,
                repositoryUrl:          this.props.repositoryUrl,
                authorName:             this.props.authorName,
                authorEmail:            this.props.authorEmail,
                authorUrl:              this.props.authorUrl,
                homepage:               this.props.homepage,
                srcDir:                 process.cwd()
            }
        );

        // APP
        // --------

        // http://yeoman.io/authoring/file-system.html - Location contexts:
        // [dest] is defined as either the current working directory
        // or the closest parent folder containing a .yo-rc.json

        // root

        this.fs.copyTpl(
            this.templatePath('_readme.txt'),
            this.destinationPath('readme.txt'), {
                authorWordPressName:    this.props.authorWordPressName,
                pluginTags:             this.props.tags,
                description:            this.props.description,
                name:                   this.props.name,
                nameSafe:               this.props.nameSafe,
                nameFriendly:           this.props.nameFriendly,
                wpVersion:              this.props.wpVersion,
                pluginLicense:          this.props.license,
                pluginLicenseUrl:       this.props.licenseUrl,
                pluginDonateUrl:        this.props.donateUrl
            }
        );

        this.fs.copyTpl(
            this.templatePath('_uninstall.php'),
            this.destinationPath('uninstall.php'), {
                name: this.props.name,
                nameFriendlySafe: this.props.nameFriendlySafe
            }
        );

        this.fs.copyTpl(
            this.templatePath('_wpdtrt-plugin-boilerplate.php'),
            this.destinationPath(this.props.name + '.php'), {
                name:                   this.props.name,
                nameFriendly:           this.props.nameFriendly,
                nameSafe:               this.props.nameSafe,
                authorName:             this.props.authorName,
                authorUrl:              this.props.authorUrl,
                pluginLicense:          this.props.license,
                pluginUrl:              this.props.homepage,
                description:            this.props.description,
                constantStub:           this.props.nameFriendlySafe.toUpperCase()
            }
        );

        // app

        this.fs.copyTpl(
            this.templatePath('app/_index.php'),
            this.destinationPath('app/index.php')
        );

        this.fs.copyTpl(
            this.templatePath('app/_wpdtrt-plugin-boilerplate-css.php'),
            this.destinationPath('app/' + this.props.name + '-css.php'), {
                name:                   this.props.name,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                nameSafe:               this.props.nameSafe,
                constantStub:           this.props.nameFriendlySafe.toUpperCase(),
                pluginUrl:              this.props.homepage
            }
        );

        this.fs.copyTpl(
            this.templatePath('app/_wpdtrt-plugin-boilerplate-data.php'),
            this.destinationPath('app/' + this.props.name + '-data.php'), {
                nameFriendlySafe:       this.props.nameFriendlySafe,
                nameSafe:               this.props.nameSafe,
                pluginUrl:              this.props.homepage
            }
        );

        this.fs.copyTpl(
            this.templatePath('app/_wpdtrt-plugin-boilerplate-html.php'),
            this.destinationPath('app/' + this.props.name + '-html.php'), {
                name:                   this.props.name,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                nameSafe:               this.props.nameSafe,
                pluginUrl:              this.props.homepage
            }
        );

        this.fs.copyTpl(
            this.templatePath('app/_wpdtrt-plugin-boilerplate-js.php'),
            this.destinationPath('app/' + this.props.name + '-js.php'), {
                name:                   this.props.name,
                nameSafe:               this.props.nameSafe,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                pluginUrl:              this.props.homepage,
                constantStub:           this.props.nameFriendlySafe.toUpperCase()
            }
        );

        this.fs.copyTpl(
            this.templatePath('app/_wpdtrt-plugin-boilerplate-options-page.php'),
            this.destinationPath('app/' + this.props.name + '-options-page.php'), {
                name:                   this.props.name,
                nameSafe:               this.props.nameSafe,
                nameFriendly:           this.props.nameFriendly,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                nameAdminMenu:          this.props.nameAdminMenu,
                pluginUrl:              this.props.homepage,
                pluginUrlAdminMenu:     this.props.urlAdminMenu,
                constantStub:           this.props.nameFriendlySafe.toUpperCase()
            }
        );

        this.fs.copyTpl(
            this.templatePath('app/_wpdtrt-plugin-boilerplate-shortcode.php'),
            this.destinationPath('app/' + this.props.name + '-shortcode.php'), {
                name:                   this.props.name,
                nameSafe:               this.props.nameSafe,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                pluginUrl:              this.props.homepage,
                constantStub:           this.props.nameFriendlySafe.toUpperCase()
            }
        );

        this.fs.copyTpl(
            this.templatePath('app/_wpdtrt-plugin-boilerplate-widget.php'),
            this.destinationPath('app/' + this.props.name + '-widget.php'), {
                name:                   this.props.name,
                nameSafe:               this.props.nameSafe,
                nameFriendly:           this.props.nameFriendly,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                pluginUrl:              this.props.homepage,
                constantStub:           this.props.nameFriendlySafe.toUpperCase()
            }
        );

        // languages

        this.fs.copy(
            this.templatePath('languages/_wpdtrt-plugin-boilerplate.pot'),
            this.destinationPath('languages/' + this.props.name + '.pot')
        );

        // views

        this.fs.copy(
            this.templatePath('views/_index.php'),
            this.destinationPath('views/index.php')
        );

        // admin

        this.fs.copy(
            this.templatePath('views/admin/_index.php'),
            this.destinationPath('views/admin/index.php')
        );

        this.fs.copyTpl(
            this.templatePath('views/admin/css/_wpdtrt-plugin-boilerplate.css'),
            this.destinationPath('views/admin/css/' + this.props.name + '.css'), {
                name:                   this.props.name,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                pluginUrl:              this.props.homepage
            }
        );

        //this.dest.mkdir(this.folderName + '/views/admin/images');
        //this.dest.mkdir(this.folderName + '/views/admin/js');

        this.fs.copyTpl(
            this.templatePath('views/admin/partials/_wpdtrt-plugin-boilerplate-options-page.php'),
            this.destinationPath('views/admin/partials/' + this.props.name + '-options-page.php'), {
                name:                   this.props.name,
                nameFriendly:           this.props.nameFriendly,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                nameSafe:               this.props.nameSafe,
                pluginUrl:              this.props.homepage
            }
        );

        this.fs.copyTpl(
            this.templatePath('views/admin/partials/_wpdtrt-plugin-boilerplate-widget.php'),
            this.destinationPath('views/admin/partials/' + this.props.name + '-widget.php'), {
                nameFriendly:           this.props.nameFriendly,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                nameSafe:               this.props.nameSafe,
                pluginUrl:              this.props.homepage
            }
        );

        // public

        this.fs.copy(
            this.templatePath('views/public/_index.php'),
            this.destinationPath('views/public/index.php')
        );

        this.fs.copyTpl(
            this.templatePath('views/public/css/_wpdtrt-plugin-boilerplate.css'),
            this.destinationPath('views/public/css/' + this.props.name + '.css'), {
                name:                   this.props.name,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                pluginUrl:              this.props.homepage
            }
        );

        this.fs.copy(
            this.templatePath('views/public/images/_tooltip-arrow.png'),
            this.destinationPath('views/public/images/tooltip-arrow.png')
        );

        this.fs.copy(
            this.templatePath('views/public/images/_treehouse-logo.png'),
            this.destinationPath('views/public/images/treehouse-logo.png')
        );


        this.fs.copyTpl(
            this.templatePath('views/public/js/_wpdtrt-plugin-boilerplate.js'),
            this.destinationPath('views/public/js/' + this.props.name + '.js'), {
                name:                   this.props.name,
                nameSafe:               this.props.nameSafe,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                pluginUrl:              this.props.homepage
            }
        );

        this.fs.copyTpl(
            this.templatePath('views/public/partials/_wpdtrt-plugin-boilerplate-front-end.php'),
            this.destinationPath('views/public/partials/' + this.props.name + '-front-end.php'), {
                name:                   this.props.name,
                nameSafe:               this.props.nameSafe,
                nameFriendlySafe:       this.props.nameFriendlySafe,
                pluginUrl:              this.props.homepage,
                constantStub:           this.props.nameFriendlySafe.toUpperCase()
            }
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
            npm: true,
            bower: true,
            yarn: false
        });

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
