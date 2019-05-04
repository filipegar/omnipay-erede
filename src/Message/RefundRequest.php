<?php


namespace Omnipay\Erede\Message;


class RefundRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount');

        $this->setUrlSuffix($this->getTransactionReference() . "/refunds");

        $data = [
            'amount' => $this->getAmountInteger(),
        ];

        return $data;
    }
}
