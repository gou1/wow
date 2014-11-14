
# braindump

composer create-project -s dev --prefer-dist manialib/symfony-skeleton maniadoge/
php bin/console generate:bundle --namespace=Nadeo/Live/ManiadogeBundle --bundle-name=ManiadogeBundle --format=yml --no-interaction --dir=src/
php bin/console doctrine:generate:entity
> ManiadogeBundle:Doge
> yml mapping
> "name" string(75)
> "imageUrl" string(255)
php bin/console doctrine:generate:entities ManiadogeBundle
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
