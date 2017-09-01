<?php

namespace Tttptd\LaravelCloudpayments\Responders;

class ResponderFactory
{

    public static function fromTransaction($transaction)
    {
        $namespace = explode('\\', get_class($transaction));
        $responderName = 'Tttptd\LaravelCloudpayments\Responders\Responder' . end($namespace);
        return new $responderName($transaction);
    }

}
