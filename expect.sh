#!/usr/bin/expect

# File: ./expect.sh
#
# Automate user interaction with Yeoman,
# by pressing ENTER at every Yeoman prompt
# after 1 second,
# to accept the default answers.
# http://www.tcl.tk/man/expect5.31/expect.1.html

# Run generators/app/index.js
spawn yo wpdtrt-plugin-boilerplate 

expect {
    "Plugin name" {sleep 1; send "\r"; exp_continue}
    "Plugin description" {sleep 1; send "\r"; exp_continue}
    "Plugin tags" {sleep 1; send "\r"; exp_continue}
    "Software version" {sleep 1; send "\r"; exp_continue}
    "Author names (first and last)" {sleep 1; send "\r"; exp_continue}
    "Author name (GitHub.com)" {sleep 1; send "\r"; exp_continue}
    "Author name (WordPress.org)" {sleep 1; send "\r"; exp_continue}
    "Author abbreviation (no spaces)" {sleep 1; send "\r"; exp_continue}
    "Author email (general)" {sleep 1; send "\r"; exp_continue}
    "Author email (plugin support)" {sleep 1; send "\r"; exp_continue}
    "Author donation URL" {sleep 1; send "\r"; exp_continue}
}
