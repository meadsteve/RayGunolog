RayGunolog
==========

Monolog Handler connection to raygun.io.

Installation
==========
Via Composer:
Add the following to your composer.json
```js
  "require": {
        "mead-steve/ray-gunolog": "dev-master"
    }
```

Usage
==========

```php

$logger  = new Monolog\Logger("Example");

$rayGunHandler = new \MeadSteve\RayGunolog\RayGunHandler(
    new \Raygun4php\RaygunClient("YOUR_RAYGUN_KEY")
);

$logger->pushHandler($rayGunHandler);

// The following error will get sent automatically to RayGun
$logger->addError("oh no!", array('exception' => new \Exception("ohnoception")));

```
