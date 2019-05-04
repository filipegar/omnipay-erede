<?php


namespace Omnipay\Erede\Message;


class CaptureRequest extends AbstractRequest
{
    public function getHttpMethod()
    {
        return 'PUT';
    }

    public function getData()
    {
        $this->validate('amount');

        $this->setUrlSuffix($this->getTransactionReference());

        $data = [
            'amount' => $this->getAmountInteger(),
        ];

        return $data;
    }
}
