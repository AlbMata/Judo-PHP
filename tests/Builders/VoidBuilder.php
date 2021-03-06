<?php

namespace Tests\Builders;

class VoidBuilder extends AbstractModelBuilder
{
    public function __construct($receiptId = '12345', $amount = 1.02)
    {
        $this->attributeValues = array(
            'receiptId'            => $receiptId,
            'yourPaymentReference' => '12345',
            'amount'               => $amount,
            'currency'             => 'GBP',
        );
    }
}
