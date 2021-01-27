#!/bin/bash
set -ev
mkdir 'wpdtrt-generated'

cd wpdtrt-generated

expect ../scripts/expect.sh
