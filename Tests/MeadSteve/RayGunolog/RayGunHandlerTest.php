<?php
namespace Tests\MeadSteve\RayGunolog;

use MeadSteve\RayGunolog\RayGunHandler;
use Monolog\Logger;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTestCase;

require_once __DIR__ . "/../../../vendor/autoload.php";

class RayGunHandlerTest extends ProphecyTestCase
{
    /**
     * @var RayGunHandler
     */
    protected $testedHandler;

    /**
     * @var Logger
     */
    protected $monolog;

    protected $mockRayGun;

    protected function setUp()
    {
        parent::setUp();
        $this->mockRayGun = $this->prophesize('\Raygun4php\RaygunClient');
        $this->testedHandler = new RayGunHandler($this->mockRayGun->reveal());

        $this->monolog = new Logger("TestLogger");
        $this->monolog->pushHandler($this->testedHandler);
    }

    public function testHandlerDefaultsToErrorOnly()
    {
        $this->mockRayGun->SendException(Argument::any(), Argument::cetera())->shouldNotBeCalled();
        $this->monolog->addInfo("Hello World");
    }

    public function testSendExceptionIsCalledOnErrors()
    {
        $this->mockRayGun->SendException(Argument::any(), Argument::cetera())->shouldBeCalledTimes(1);
        $this->monolog->addError("Oh no!");
    }

    public function testSendExceptionGetsPassedExceptionIfAvailable()
    {
        $sentException = new \Exception("Testing");
        $this->mockRayGun->SendException($sentException, Argument::cetera())->shouldBeCalledTimes(1);
        $this->monolog->addError("Oh no!", array("exception" => $sentException));
    }

}
 