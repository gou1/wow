# Resting with my doges

![Doge](http://upload.wikimedia.org/wikipedia/en/5/5f/Original_Doge_meme.jpg)

This is a sandbox to create an online service to manage Doge's in Maniaplanet.

It exposes a REST Symfony2 API built with current best practices (FOSRestBundle, JMSSerializerBundle, NelmioApiDocBundle).

A Maniascript application provides a frontend to that API for the Maniaplanet client.

# braindump

## Getting started

    composer create-project -s dev --prefer-dist manialib/symfony-skeleton maniadoge/
    php bin/console generate:bundle --namespace=Nadeo/Live/ManiadogeBundle --bundle-name=ManiadogeBundle --format=yml --no-interaction --dir=src/

## Working with ORM

    php bin/console doctrine:generate:entity

> ManiadogeBundle:Doge

> yml mapping

> "name" string(75)

> "imageUrl" string(255)

    php bin/console doctrine:generate:entities ManiadogeBundle
    php bin/console doctrine:database:create
    php bin/console doctrine:schema:update --force

## Data fixtures

    php bin/console doctrine:fixtures:load


