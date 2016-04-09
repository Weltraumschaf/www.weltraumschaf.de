#!/usr/bin/env bash

juberblog publish -c configuration/configuration.properties
sassc sass/main.scss public/css/main.css
chmod -R a+rX public/
