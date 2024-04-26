#!/bin/bash

docker-compose run -T --rm php-cli56 <<INPUT
rm vendor -Rf
composer install --no-dev --optimize-autoloader
INPUT

RELEASE_VERSION=$(grep -Po "this->version = '\K\d\.\d\.\d" gtmconsentmodebannerfree.php)
RELEASE_DIR="dist/tag-concierge-gtm-consent-mode-banner-free-$RELEASE_VERSION"
RELEASE_FILE="tag-concierge-gtm-consent-mode-banner-free-$RELEASE_VERSION.zip"

rm -Rf $RELEASE_DIR
mkdir -p $RELEASE_DIR/gtmconsentmodebannerfree

cp -R src $RELEASE_DIR/gtmconsentmodebannerfree/src
cp -R upgrade $RELEASE_DIR/gtmconsentmodebannerfree/upgrade
cp -R vendor $RELEASE_DIR/gtmconsentmodebannerfree/vendor
cp -R views $RELEASE_DIR/gtmconsentmodebannerfree/views
cp logo.png $RELEASE_DIR/gtmconsentmodebannerfree/logo.png
cp gtmconsentmodebannerfree.php $RELEASE_DIR/gtmconsentmodebannerfree/gtmconsentmodebannerfree.php
cp LICENSE.md $RELEASE_DIR/gtmconsentmodebannerfree/LICENSE.md

docker-compose run -T --rm php-cli71 <<INPUT
find $RELEASE_DIR/gtmconsentmodebannerfree/src -type f -name '*.php' | xargs sed -i 's/^namespace \(.*\);/namespace \1;\n\nif (!defined('\''_PS_VERSION_'\'')) {\n    exit;\n}/g'
touch $RELEASE_DIR/gtmconsentmodebannerfree/.htaccess
composer install
./vendor/bin/autoindex prestashop:add:index $RELEASE_DIR/gtmconsentmodebannerfree
cp vendor/prestashop/autoindex/assets/index.php $RELEASE_DIR/gtmconsentmodebannerfree/index.php
./vendor/bin/header-stamp --license=docs/LICENSE_HEADER.txt --target=$RELEASE_DIR/gtmconsentmodebannerfree
./vendor/bin/php-cs-fixer fix $RELEASE_DIR/gtmconsentmodebannerfree/src
./vendor/bin/php-cs-fixer fix $RELEASE_DIR/gtmconsentmodebannerfree/views
./vendor/bin/php-cs-fixer fix $RELEASE_DIR/gtmconsentmodebannerfree/index.php
./vendor/bin/php-cs-fixer fix $RELEASE_DIR/gtmconsentmodebannerfree/gtmconsentmodebannerfree.php
INPUT

cd $RELEASE_DIR && zip -r $RELEASE_FILE . && mv $RELEASE_FILE "../$RELEASE_FILE" && cd -

rm -Rf $RELEASE_DIR
