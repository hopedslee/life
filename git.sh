#!/bin/bash

/usr/bin/git add /home/dslee/life

today=$(date +%Y-%m-%d)
echo $today
#/usr/bin/git commit -m "$today $1"
/usr/bin/git commit -m "Schema change edate, etype"
/usr/bin/git push -u origin master

exit 0
