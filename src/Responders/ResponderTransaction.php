<?php

namespace Tttptd\LaravelCloudpayments\Responders;

use CloudPayments\Model\Transaction;
use ReflectionClass;
use ReflectionProperty;

class ResponderTransaction extends ResponderContract
{

    /**
     * @var Transaction
     */
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function respond():array
    {
        $transaction = $this->transaction;
        dump($transaction);
        $reflect = new ReflectionClass($transaction);
        $props = array_reduce(
            $reflect->getProperties(ReflectionProperty::IS_PROTECTED),
            function($acc, $it) use ($transaction) {
                $it->setAccessible(true);
                $acc[$it->getName()] = $it->getValue($transaction);
                return $acc;
            }, []
        );

        return [
            'success' => true,
            'type' => 'transaction',
            'data' => $props,
        ];
    }

}
