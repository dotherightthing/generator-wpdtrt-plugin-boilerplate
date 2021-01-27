#!/bin/bash
set -ev
mkdir 'wpdtrt-travistest'

cd wpdtrt-travistest

expect ../scripts/expect.sh
