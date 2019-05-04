<?php


namespace Omnipay\Erede\Message;


class PurchaseRequest extends GenericTransaction
{
    public function getData()
    {
        $data = parent::getData();

        $data['capture'] = true;

        return $data;
    }
}
