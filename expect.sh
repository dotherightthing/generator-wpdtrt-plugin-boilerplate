#!/usr/bin/expect

# Test user interaction with Yeoman,
# pressing ENTER at any Yeoman prompt, once a second,
# to accept the default answers.
# http://www.tcl.tk/man/expect5.31/expect.1.html

spawn yo wpdtrt-plugin-boilerplate 

expect {
    "Plugin name" {send "\r"; exp_continue}
    "Plugin description" {send "\r"; exp_continue}
    "Plugin tags" {send "\r"; exp_continue}
    "Software version" {send "\r"; exp_continue}
    "Author names (first and last)" {send "\r"; exp_continue}
    "Author name (GitHub.com)" {send "\r"; exp_continue}
    "Author name (WordPress.org)" {send "\r"; exp_continue}
    "Author abbreviation (no spaces)" {send "\r"; exp_continue}
    "Author email (general)" {send "\r"; exp_continue}
    "Author email (plugin support)" {send "\r"; exp_continue}
    "Author donation URL" {send "\r"; exp_continue}
    "Base URL for testing web pages in Cypress.io" {send "\r";}
}
