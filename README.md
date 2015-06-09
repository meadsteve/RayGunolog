RayGunolog
==========
Monolog Handler connection to raygun.io.

Build status
------------

| branch | status |
| ------ | ------ |
| master | [![Build Status](https://travis-ci.org/meadsteve/RayGunolog.png?branch=master)](https://travis-ci.org/meadsteve/RayGunolog) |


Installation
------------
Via Composer:
Add the following to your composer.json
```js
  "require": {
        "mead-steve/ray-gunolog": "^1.0.0"
    }
```

Usage
------------

```php

$logger  = new Monolog\Logger("Example");

$rayGunHandler = new \MeadSteve\RayGunolog\RayGunHandler(
    new \Raygun4php\RaygunClient("YOUR_RAYGUN_KEY")
);

$logger->pushHandler($rayGunHandler);

// The following error will get sent automatically to RayGun
$logger->addError("oh no!", array('exception' => new \Exception("ohnoception")));

```
