<?php

namespace Tttptd\LaravelCloudpayments\Responders;

use Exception;

class ResponderFactory
{

    /**
     * @param $transaction
     * @return ResponderContract
     */
    public static function fromTransaction($transaction)
    {
        $namespace = explode('\\', get_class($transaction));
        $responderName = 'Tttptd\LaravelCloudpayments\Responders\Responder' . end($namespace);
        return new $responderName($transaction);
    }

    public static function fromException(Exception $exception)
    {
        $namespace = explode('\\', get_class($exception));
        $responderName = 'Tttptd\LaravelCloudpayments\Responders\Responder' . end($namespace);
        return new $responderName($exception);
    }

}
