# Twig OrdinalNumber Extension
[![Build Status](https://travis-ci.org/fvozar/twig-ordinal-number-filter.svg?branch=master)](https://travis-ci.org/fvozar/twig-ordinal-number-filter)

A Twig Extension filter to format number into ordinal form (1st, 2nd, etc.).

## Install
With composer
```
composer require fvozar/twig-ordinal-number-filter
```
## Usage
Basic usage is just put ordinal filter on your number.

```twig
{{ someNumber | ordinal }}
```

You can also provide another locale for internally used \NumberFormatter class
```twig
{{ someNumber | ordinal('sk') }}
```

For Symfony usage you'll want to add it as a service and tag it for Twig.

```yml
# app/config/services.yml
services:
    twig.extension.ordinal:
        class: Fvozar\Twig\OrdinalNumberExtension
        tags:
            - { name: twig.extension }
```
