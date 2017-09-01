<?php

namespace Tttptd\LaravelCloudpayments\Responders;

use CloudPayments\Model\Required3DS;

class ResponderRequired3DS extends ResponderContract
{

    /**
     * @var Required3DS
     */
    private $transaction;

    /**
     * ResponderRequired3DS constructor.
     * @param Required3DS $transaction
     */
    public function __construct(Required3DS $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @return array
     */
    public function respond():array
    {
        return [
            'success' => true,
            'type' => 'required3ds',
            'data' => [
                'url' => $this->transaction->getUrl(),
                'transactionId' => $this->transaction->getTransactionId(),
                'token' => $this->transaction->getToken(),
            ],
        ];
    }

}
