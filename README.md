RayGunolog
==========

Monolog Handler connection to raygun.io.

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
