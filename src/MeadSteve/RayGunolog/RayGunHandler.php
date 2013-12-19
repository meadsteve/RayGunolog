<?php

namespace MeadSteve\RayGunolog;

class RayGunHandler extends \Monolog\Handler\AbstractProcessingHandler
{
    /**
     * @var \Raygun4php\RaygunClient
     */
    protected $client;

    function __construct(
      \Raygun4php\RaygunClient $raygunClient,
      $level = \Monolog\Logger::ERROR,
      $bubble = true
    )
    {
        parent::__construct($level, $bubble);
        $this->client = $raygunClient;
    }


    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     * @return void
     */
    protected function write(array $record) {
        if (isset($record['context']['exception'])) {
            $exceptionToSend = $record['context']['exception'];
        } else {
            $exceptionToSend = new \Exception((string) $record['formatted']);
        }
        $this->client->SendException($exceptionToSend, array(), $record['extra']);
    }

} 