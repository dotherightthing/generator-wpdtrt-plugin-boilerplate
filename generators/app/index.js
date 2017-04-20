/*
Extend a base generator:

Yeoman offers base generators which you can extend to implement your own behavior. These base generators will add most of the functionality you'd expect to ease your task.

The extend method will extend the base class and allow you to provide a new prototype.

We assign the extended generator to module.exports to make it available to the ecosystem. This is how we export modules in Node.js.
*/

'use strict';

//Require dependencies
var yeoman = require('yeoman-generator');
//var yosay = require('yosay');

module.exports = yeoman.generators.Base.extend({

    // based on https://github.com/yeoman/generator-generator/blob/master/app/index.js

    prompting: function () {

    /**
     * We are using the async() method to make sure that the function does not exit
     * before the actual work gets completed.
     */
        var done = this.async();

    /**
     * The prompt method is used to get the user’s input which is of type input as there are other types.
     * The name property of the prompt is used to access the field’s value from the project
     * The message is the instruction
     * We also want it to default to the folder name if we do not provide a name while scaffolding.
     */
        var prompts = [
            {
                type: 'input',
                name: 'pluginName',
                message: 'Plugin name (file safe)',
                //Defaults to the project's folder name if the input is skipped
                default: 'wpdtrt-plugin-boilerplate' // this.appname
            },
            {
                type: 'input',
                name: 'pluginNameSafe',
                message: 'Plugin name (function safe)',
                default: 'wpdtrt_plugin_boilerplate'
            },
            {
                type: 'input',
                name: 'pluginNameFriendly',
                message: 'Plugin name (friendly)',
                default: 'WP DTRT Plugin Boilerplate'
            },
            {
                type: 'input',
                name: 'pluginNameFriendlySafe',
                message: 'Plugin name (friendly & function safe)',
                default: 'WpDTRT_Plugin_Boilerplate'
            },
            {
                type: 'input',
                name: 'pluginNameAdminMenu',
                message: 'Plugin name (admin menu)',
                default: 'Plugin Boilerplate'
            },
            {
                type: 'input',
                name: 'pluginUrlAdminMenu',
                message: 'Plugin URL (admin menu)',
                default: 'boilerplate'
            },
            {
                type: 'input',
                name: 'pluginDescription',
                message: 'Plugin description',
                default: 'A best-practice boilerplate for plugin development'
            },
            {
                type: 'input',
                name: 'pluginTags',
                message: 'Plugin tags',
                default: 'boilerplate, best-practice'
            },
            {
                type: 'input',
                name: 'pluginUrl',
                message: 'Plugin URL',
                default: 'http://dotherightthing.co.nz'
            },
            {
                type: 'input',
                name: 'pluginLicense',
                message: 'Plugin License',
                default: 'GPLv2 or later'
            },
            {
                type: 'input',
                name: 'pluginLicenseUrl',
                message: 'Plugin License URL',
                default: 'http://www.gnu.org/licenses/gpl-2.0.html'
            },
            {
                type: 'input',
                name: 'pluginDonateUrl',
                message: 'Plugin Donate URL',
                default: 'http://dotherightthing.co.nz'
            },
            {
                type: 'input',
                name: 'wpVersion',
                message: 'WordPress version',
                default: '4.7.3'
            },
            {
                type: 'input',
                name: 'authorName',
                message: 'Your first and last names',
                default: 'Dan Smith'
            },
            {
                type: 'input',
                name: 'authorWordPressName',
                message: 'Your WordPress.org username',
                default: 'dotherightthingnz'
            },
            {
                type: 'input',
                name: 'authorEmail',
                message: 'Your email address',
                default: 'dev@dotherightthing.co.nz'
            },
            {
                type: 'input',
                name: 'authorUrl',
                message: 'Author URL',
                default: 'http://dotherightthing.co.nz'
            },
            {
                type: 'input',
                name: 'pluginRepositoryType',
                message: 'Version control system (git/svn)',
                default: 'git'
            },
            {
                type: 'input',
                name: 'pluginRepositoryUrl',
                message: 'Repository Url',
                default: 'git@bitbucket.org:dotherightthing/wpdtrt-plugin-boilerplate.git'
            }
        ];

    /**
     * The second argument of prompt is a callback which holds the values from the prompt(s).
     * This allows the answers to be accessed from the “writing” logic.
     */
        this.prompt( prompts,
            function(props) {

                this.pluginName = props.pluginName;
                this.pluginNameSafe = props.pluginNameSafe;
                this.pluginNameFriendly = props.pluginNameFriendly;
                this.pluginNameFriendlySafe = props.pluginNameFriendlySafe;
                this.pluginNameAdminMenu = props.pluginNameAdminMenu;
                this.pluginDescription = props.pluginDescription;
                this.pluginTags = props.pluginTags;
                this.pluginUrl = props.pluginUrl;
                this.pluginUrlAdminMenu = props.pluginUrlAdminMenu;
                this.pluginLicense = props.pluginLicense;
                this.pluginLicenseUrl = props.pluginLicenseUrl;
                this.pluginDonateUrl = props.pluginDonateUrl;
                this.pluginRepositoryType = props.pluginRepositoryType;
                this.pluginRepositoryUrl = props.pluginRepositoryUrl;

                this.wpVersion = props.wpVersion;

                this.authorName = props.authorName;
                this.authorWordPressName = props.authorWordPressName;
                this.authorEmail = props.authorEmail;
                this.authorUrl = props.authorUrl;

                done();
            }
            .bind(this)
        );
    },

    writing: {

        // method names can be anything (at least, because this is the only generator this project will use)
        // and are run automatically

        setup: function() {
            // cd generator-wp-plugin-boilerplate
            this.config.save(); // creates a .yo-rc.json file in this directory
        },

        config: function() {

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
                    name:           this.props.pluginName,
                    description:    this.props.pluginDescription,
                    authorName:     this.props.authorName,
                    authorEmail:    this.props.authorEmail,
                    authorUrl:      this.props.authorUrl,
                    homepage:       this.props.pluginUrl
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

            this.fs.copy(
                this.templatePath('_composer.phar'),
                this.destinationPath('composer.phar')
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
                    name:           this.props.pluginName,
                    description:    this.props.pluginDescription,
                    repositoryType: this.props.pluginRepositoryType,
                    repositoryUrl:  this.props.pluginRepositoryUrl,
                    authorName:     this.props.authorName,
                    authorEmail:    this.props.authorEmail,
                    authorUrl:      this.props.authorUrl,
                    homepage:       this.props.pluginUrl,
                    srcDir:         process.cwd()
                }
            );

            done();

        },

        app: function() {

            // http://yeoman.io/authoring/file-system.html - Location contexts:
            // [dest] is defined as either the current working directory
            // or the closest parent folder containing a .yo-rc.json

            // root

            this.fs.copyTpl(
                this.templatePath('_readme.txt'),
                this.destinationPath('readme.txt'), {
                    authorWordPressName:    this.props.authorWordPressName,
                    pluginTags:             this.props.pluginTags,
                    description:            this.props.pluginDescription,
                    name:                   this.props.pluginName,
                    nameFriendly:           this.props.pluginNameFriendly,
                    wpVersion:              this.props.wpVersion,
                    pluginLicense:          this.props.pluginLicense,
                    pluginLicenseUrl:       this.props.pluginLicenseUrl
                }
            );

            this.fs.copyTpl(
                this.templatePath('_uninstall.php'),
                this.destinationPath('uninstall.php'), {
                    name: this.props.pluginName,
                    nameFriendlySafe: this.props.pluginNameFriendlySafe
                }
            );

            this.fs.copyTpl(
                this.templatePath('_wpdtrt-plugin-boilerplate.php'),
                this.destinationPath(this.pluginName + '.php'), {
                    name:                   this.props.pluginName,
                    nameFriendly:           this.props.pluginNameFriendly,
                    nameSafe:               this.props.pluginNameSafe,
                    authorName:             this.props.authorName,
                    authorUrl:              this.props.authorUrl,
                    pluginLicense:          this.props.pluginLicense,
                    pluginUrl:              this.props.pluginUrl,
                    description:            this.props.pluginDescription,
                    constantStub:           this.props.pluginNameFriendly.toUpperCase()
                }
            );

            // app

            this.fs.copyTpl(
                this.templatePath('app/_index.php'),
                this.destinationPath('app/index.php')
            );

            this.fs.copyTpl(
                this.templatePath('app/_wpdtrt-plugin-boilerplate-css.php'),
                this.destinationPath('app/' + this.pluginName + '-css.php'), {
                    name:                   this.props.pluginName,
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    nameSafe:               this.props.pluginNameSafe,
                    constantStub:           this.props.pluginNameFriendly.toUpperCase(),
                    pluginUrl:              this.props.pluginUrl
                }
            );

            this.fs.copyTpl(
                this.templatePath('app/_wpdtrt-plugin-boilerplate-data.php'),
                this.destinationPath('app/' + this.pluginName + '-data.php'), {
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    nameSafe:               this.props.pluginNameSafe,
                    pluginUrl:              this.props.pluginUrl
                }
            );

            this.fs.copyTpl(
                this.templatePath('app/_wpdtrt-plugin-boilerplate-js.php'),
                this.destinationPath('app/' + this.pluginName + '-js.php'), {
                    name:                   this.props.pluginName,
                    nameSafe:               this.props.pluginNameSafe,
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    pluginUrl:              this.props.pluginUrl,
                    constantStub:           this.props.pluginNameFriendly.toUpperCase()
                }
            );

            this.fs.copyTpl(
                this.templatePath('app/_wpdtrt-plugin-boilerplate-options-page.php'),
                this.destinationPath('app/' + this.pluginName + '-options-page.php'), {
                    name:                   this.props.pluginName,
                    nameSafe:               this.props.pluginNameSafe,
                    nameFriendly:           this.props.pluginNameFriendly,
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    nameAdminMenu:          this.props.pluginNameAdminMenu,
                    pluginUrl:              this.props.pluginUrl,
                    pluginUrlAdminMenu:     this.props.pluginUrlAdminMenu,
                    constantStub:           this.props.pluginNameFriendly.toUpperCase()
                }
            );

            this.fs.copyTpl(
                this.templatePath('app/_wpdtrt-plugin-boilerplate-shortcode.php'),
                this.destinationPath('app/' + this.pluginName + '-shortcode.php'), {
                    nameSafe:               this.props.pluginNameSafe,
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    pluginUrl:              this.props.pluginUrl,
                    constantStub:           this.props.pluginNameFriendly.toUpperCase()
                }
            );

            this.fs.copyTpl(
                this.templatePath('app/_wpdtrt-plugin-boilerplate-widget.php'),
                this.destinationPath('app/' + this.pluginName + '-widget.php'), {
                    name:                   this.props.pluginName,
                    nameSafe:               this.props.pluginNameSafe,
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    pluginUrl:              this.props.pluginUrl,
                    constantStub:           this.props.pluginNameFriendly.toUpperCase()
                }
            );

            // languages

            this.fs.copy(
                this.templatePath('languages/_wpdtrt-plugin-boilerplate.pot'),
                this.destinationPath('languages/' + this.pluginName + '.pot')
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
                this.destinationPath('views/admin/css/' + this.pluginName + '.css'), {
                    name:                   this.props.pluginName,
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    pluginUrl:              this.props.pluginUrl
                }
            );

            //this.dest.mkdir(this.folderName + '/views/admin/images');
            //this.dest.mkdir(this.folderName + '/views/admin/js');

            this.fs.copyTpl(
                this.templatePath('views/admin/partials/_wpdtrt-plugin-boilerplate-options-page.php'),
                this.destinationPath('views/admin/partials/' + this.pluginName + '-options-page.php'), {
                    name:                   this.props.pluginName,
                    nameFriendly:           this.props.pluginNameFriendly,
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    nameSafe:               this.props.pluginNameSafe,
                    pluginUrl:              this.props.pluginUrl
                }
            );

            this.fs.copyTpl(
                this.templatePath('views/admin/partials/_wpdtrt-plugin-boilerplate-widget.php'),
                this.destinationPath('views/admin/partials/' + this.pluginName + '-widget.php'), {
                    nameFriendly:           this.props.pluginNameFriendly,
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    nameSafe:               this.props.pluginNameSafe,
                    pluginUrl:              this.props.pluginUrl
                }
            );

            // public

            this.fs.copy(
                this.templatePath('views/public/_index.php'),
                this.destinationPath('views/public/index.php')
            );

            this.fs.copyTpl(
                this.templatePath('views/public/css/_wpdtrt-plugin-boilerplate.css'),
                this.destinationPath('views/public/css/' + this.pluginName + '.css'), {
                    name:                   this.props.pluginName,
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    pluginUrl:              this.props.pluginUrl
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
                this.destinationPath('views/public/js/' + this.pluginName + '.js'), {
                    name:                   this.props.pluginName,
                    nameSafe:               this.props.pluginNameSafe,
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    pluginUrl:              this.props.pluginUrl
                }
            );

            this.fs.copyTpl(
                this.templatePath('views/public/partials/_wpdtrt-plugin-boilerplate-front-end.php'),
                this.destinationPath('views/public/partials/' + this.pluginName + '-front-end.php'), {
                    name:                   this.props.pluginName,
                    nameSafe:               this.props.pluginNameSafe,
                    nameFriendlySafe:       this.props.pluginNameFriendlySafe,
                    pluginUrl:              this.props.pluginUrl,
                    constantStub:           this.props.pluginNameFriendly.toUpperCase()
                }
            );

            done();
        },

        install: function() {

            this.installDependencies();

            done();
        }
    }
});

// NB: when finished authoring this file, run npm link
// so that yo GENERATOR_NAME is available in Terminal
// i.e: yo wp-plugin-boilerplate
// or choose an option, via: yo