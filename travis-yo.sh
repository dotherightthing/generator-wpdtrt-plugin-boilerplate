#!/bin/bash
set -ev

mkdir 'wpdtrt-generated-plugin'

cd wpdtrt-generated-plugin

yo wp-plugin-boilerplate

expect "? Plugin name (file safe) (wpdtrt-generated-plugin) "
send "\r"
