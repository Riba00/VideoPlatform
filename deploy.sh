#!/usr/bin/env sh

git checkout production
git merge main
git push origin production
git checkout main

wget https://forge.laravel.com/servers/601954/sites/1836574/deploy/http?token=h2YwysyVuxTwf76UWt453k8TGEN8YGOEfrMf8aoO -O /dev/null
