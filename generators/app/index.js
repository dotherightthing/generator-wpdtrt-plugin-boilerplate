/*
Extend a base generator:

Yeoman offers base generators which you can extend to implement your own behavior. These base generators will add most of the functionality you'd expect to ease your task.

The extend method will extend the base class and allow you to provide a new prototype.

We assign the extended generator to module.exports to make it available to the ecosystem. This is how we export modules in Node.js.
*/

var yeoman = require('yeoman-generator');

module.exports = yeoman.generators.Base.extend({

    // based on https://github.com/yeoman/generator-generator/blob/master/app/index.js

    prompting: {

        askForProjectDetails1: function () {
            var done = this.async(); // this seems to wait for the response

            this.placeholder = {
                pluginName: 'wpdtrt-plugin-boilerplate',
                pluginNameFriendly: 'DTRT Plugin Boilerplate',
                pluginDescription: 'A best-practice boilerplate for plugin development',
                pluginUrl: 'http://dotherightthing.co.nz',
                authorName: 'Dan Smith',
                authorEmail: 'dev@dotherightthing.co.nz',
                authorUrl: 'http://dotherightthing.co.nz'
            };

            var prompts = [
                {
                    name: 'pluginName',
                    message: 'Plugin name',
                    default: this.placeholder.pluginName
                },
                {
                    name: 'pluginNameFriendly',
                    message: 'Plugin name (friendly)',
                    default: this.placeholder.pluginNameFriendly
                },
                {
                    name: 'pluginDescription',
                    message: 'Plugin description',
                    default: this.placeholder.pluginDescription
                },
                {
                    name: 'pluginUrl',
                    message: 'Plugin URL',
                    default: this.placeholder.pluginUrl
                },
                {
                    name: 'authorName',
                    message: 'Your first and last names',
                    default: this.placeholder.authorName
                },
                {
                    name: 'authorEmail',
                    message: 'Your email address',
                    default: this.placeholder.authorEmail
                },
                {
                    name: 'authorUrl',
                    message: 'Author URL',
                    default: this.placeholder.authorUrl
                }
            ];

            this.prompt(prompts, function(props) {
                this.pluginName = props.pluginName;
                this.pluginNameFriendly = props.pluginNameFriendly;
                this.pluginDescription = props.pluginDescription;
                this.pluginUrl = props.pluginUrl;
                this.authorName = props.authorName;
                this.authorEmail = props.authorEmail;
                this.authorUrl = props.authorUrl;
                done();
            }.bind(this));
        },

        // has to run second so that this.pluginName is available
        askForProjectDetails2: function () {
            var done = this.async(); // this seems to wait for the response

            this.placeholder.projectRepositoryType = 'git';
            this.placeholder.projectRepositoryUrl = 'git@bitbucket.org:dotherightthing/' + this.pluginName + '.git';

            var prompts = [
                {
                    name: 'projectRepositoryType',
                    message: 'Version control system (git/svn)',
                    default: this.placeholder.projectRepositoryType
                },
                {
                    name: 'projectRepositoryUrl',
                    message: 'Repository Url',
                    default: this.placeholder.projectRepositoryUrl
                }
            ];

            this.prompt(prompts, function(props) {
                this.projectRepositoryType = props.projectRepositoryType;
                this.projectRepositoryUrl = props.projectRepositoryUrl;
                done();
            }.bind(this));
        }

    },

    writing: {

        // method names can be anything (at least, because this is the only generator this project will use)
        // and are run automatically

        setup: function() {
            // cd generator-wp-plugin-boilerplate
            this.config.save(); // creates a .yo-rc.json file in this directory
        },

        package_json: function() {

            var pkg = {
              "name": this.pluginName, // this.pluginNameFriendly.dashify(),
              "version": "0.1.0",
              "description": this.pluginDescription,
              "main": "readme.txt",
              "author": this.authorName + ' <' + this.authorEmail + '>',
              "homepage": this.pluginUrl,
              "license": "ISC",
              "repository": {
                "type": this.projectRepositoryType,
                "url": this.projectRepositoryUrl
              },
              "dependencies": {},
              "devDependencies": {
                "gulp-phplint": "^0.3.4",
                "gulp-phpunit": "^0.22.2"
              },
              "scripts": {
                "test": "echo \"Error: no test specified\" && exit 1"
              },
              "srcDir": process.cwd(),
            };

            // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/JSON/stringify
            this.write('package.json',JSON.stringify(pkg, null, '\t')); // pretty printed with tabs rather than minified
            //this.write('package.json', pkg); // [object][object]

        },

        scaffold_root: function() {

            // Bower scaffolding
            this.src.copy('.bowerrc', '.bowerrc');

            // Git config
            this.src.copy('.gitignore', '.gitignore');

            // Composer
            this.src.copy('composer.json', 'composer.json');
            this.src.copy('composer.lock', 'composer.lock');
            this.src.copy('composer.phar', 'composer.phar');

            // Gulp scripts
            this.src.copy('gulpfile.js', 'gulpfile.js');

            // NPM
            // See package_json, above

            // WordPress Plugin readme
            this.src.copy('readme.txt', 'readme.txt');

            // WordPress Plugin magic uninstaller
            this.src.copy('uninstall.php', 'uninstall.php');

            // WordPress Plugin/importer
            this.src.copy('wpdtrt-plugin-boilerplate.php', this.pluginName + '.php');
        },

        scaffold_app: function() {

            // http://yeoman.io/authoring/file-system.html - Location contexts:
            // [dest] is defined as either the current working directory
            // or the closest parent folder containing a .yo-rc.json

            // app

            //this.dest.mkdir('app');

            this.src.copy(
                'app/index.php',
                'app/index.php'

            );
            this.src.copy(
                'app/wpdtrt-plugin-boilerplate-css.php',
                'app/' + this.pluginName + '-css.php'
            );
            this.src.copy(
                'app/wpdtrt-plugin-boilerplate-data.php',
                'app/' + this.pluginName + '-data.php'
            );
            this.src.copy(
                'app/wpdtrt-plugin-boilerplate-js.php',
                'app/' + this.pluginName + '-js.php'
            );
            this.src.copy(
                'app/wpdtrt-plugin-boilerplate-options-page.php',
                'app/' + this.pluginName + '-options-page.php'
            );
            this.src.copy(
                'app/wpdtrt-plugin-boilerplate-shortcode.php',
                'app/' + this.pluginName + '-shortcode.php'
            );
            this.src.copy(
                'app/wpdtrt-plugin-boilerplate-widget.php',
                'app/' + this.pluginName + '-widget.php'
            );

            // languages

            this.src.copy('languages/wpdtrt-plugin-boilerplate.pot',            ('languages/' + this.pluginName + '.pot'));

            // views

            this.src.copy(
                'views/admin/css/wpdtrt-plugin-boilerplate.css',
                'views/admin/css/' + this.pluginName + '.css'
            );

            this.dest.mkdir(this.folderName + '/views/admin/images');
            this.dest.mkdir(this.folderName + '/views/admin/js');

            this.src.copy(
                'views/admin/partials/wpdtrt-plugin-boilerplate-options-page.php',
                'views/admin/partials/' + this.pluginName + '.php'
            );
            this.src.copy(
                'views/admin/partials/wpdtrt-plugin-boilerplate-widget.php',
                'views/admin/partials/' + this.pluginName + '.php'
            );

            this.src.copy(
                'views/public/css/wpdtrt-plugin-boilerplate.css',
                'views/public/css/' + this.pluginName + '.css'
            );

            this.src.copy(
                'views/public/images/tooltip-arrow.png',
                'views/public/images/tooltip-arrow.png'
            );
            this.src.copy(
                'views/public/images/treehouse-logo.png',
                'views/public/images/treehouse-logo.png'
            );

            this.src.copy(
                'views/public/js/wpdtrt-plugin-boilerplate.js',
                'views/public/js/' + this.pluginName + '.js'
            );

            this.src.copy(
                'views/public/partials/wpdtrt-plugin-boilerplate-front-end.php',
                'views/public/partials/' + this.pluginName + '-front-end.php'
            );

            // Copy templates from app/templates to the scaffolded folder structure
            // http://yeoman.github.io/generator/actions.html
            // Note: this.src.copy(FILE, DEST_folderName); // this is only good for single files
        }

    }
});

// NB: when finished authoring this file, run npm link
// so that yo GENERATOR_NAME is available in Terminal
// i.e: yo wp-plugin-boilerplate
// or choose an option, via: yo