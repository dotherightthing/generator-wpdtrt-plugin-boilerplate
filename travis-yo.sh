#!/bin/bash
set -ev
spawn yo wp-plugin-boilerplate

expect "? Plugin name (file safe) (wpdtrt-generated-plugin)"
send "\r"
