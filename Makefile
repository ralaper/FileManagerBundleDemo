CONSOLE = php bin/console
COMPOSER = composer

install_bundle:
	rm -rf bundles/*
	cd bundles && git clone git@github.com:artgris/FileManagerBundle.git

auto-load:
	composer dump-autoload

install-ckeditor:
	php bin/console ckeditor:install public/bundles/fosckeditor/
