<?php

namespace Tttptd\LaravelCloudpayments\Responders;

use CloudPayments\Exception\PaymentException;

class ResponderPaymentException extends ResponderContract
{

    /**
     * @var PaymentException
     */
    private $exception;

    public function __construct(PaymentException $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return array
     */
    public function respond():array
    {
        return [
            'success' => false,
            'reason' => $this->exception->getMessage(),
            'message' => $this->exception->getCardHolderMessage(),
        ];
    }

}
