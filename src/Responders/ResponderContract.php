<?php

namespace Tttptd\LaravelCloudpayments\Responders;

abstract class ResponderContract
{

    /**
     * Usage:
     * <code>
     * ResponderFactory::fromTransaction($transaction)->respond();
     * </code>
     * @return array
     */
    abstract public function respond():array;

}
