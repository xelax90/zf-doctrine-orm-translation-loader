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

Translation Keys should not start with `__META__` since this prefix is used for
storing metadata. Using `__META__plural_forms` in particular will lead to 
unwanted side-effects.

### Plural translations

You can store plural translations by using the translationPluralNumber property 
of the `DoctrineORMTranslationLoader\Entity\Translation` entity. Provide a 
translation for each plural form in your plural rule and use the translator's 
`translatePlural` function to choose the correct form.

### Meta data

You can also store meta data (such as the plural forms) for each locale and domain.
Each meta entry must have a translation key starting with `__META__` followed by 
the meta identifier. Meta rules are not deleted from the translator which makes 
it possible to use them as translation keys, although it is not recommended. As 
of now, only the plural_forms identifier is interpreted.

The `DoctrineORMTranslationLoader\I18n\Translator\Loader\DoctrineEntity` class 
provides constants for the meta prefix and the `plural_forms` identifier which 
you might find useful when adding or reading metadata in a PHP script.

To store the plural rules for a local and domain, use `__META__plural_forms` as 
the translation key. For details about the plural rule syntax, please refer to 
the [Zend_i18n documentation](https://docs.zendframework.com/zend-i18n/).