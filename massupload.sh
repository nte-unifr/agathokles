#!/bin/bash

FILES=/var/www/tests/tmp/tmp/*
for f in $FILES
do
    php app/console sonata:media:add sonata.media.provider.image default $f
done
