# Doctrine database translation loader for Zend Framework 3

This module adds an additional translation loader that uses Doctrine ORM to 
store translations.

## Installation

Installation of LanguageRoute uses composer. For composer documentation, please 
refer to [getcomposer.org](http://getcomposer.org/).

```sh
composer require xelax90/zf-doctrine-orm-translation-loader
```

Then add `DoctrineORMTranslationLoader` to your `config/application.config.php`
and run the doctrine schema update to create the database table:

```sh
php vendor/bin/doctrine-module orm:schema-tool:update --force 
```

## Usage

This module uses the `DoctrineORMTranslationLoader\Entity\Translation` entity
to store translations. To add new translations, simply add new entities using
Doctrine or directly add them into the `translation` database table. The 
default translator will automatically use the provided loader and the 
`translate()` function/view helper will search the database for translations.
