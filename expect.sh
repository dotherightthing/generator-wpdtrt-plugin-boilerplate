#!/usr/bin/expect

# Test user interaction with Yeoman,
# pressing ENTER at any Yeoman prompt, once a second,
# to accept the default answers.
# http://www.tcl.tk/man/expect5.31/expect.1.html

set timeout 1

spawn yo wp-plugin-boilerplate 

expect {
    timeout {send "\r"; exp_continue}
}
