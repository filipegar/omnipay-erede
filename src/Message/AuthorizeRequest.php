<?php

namespace Omnipay\Erede\Message;

class AuthorizeRequest extends GenericTransaction
{
    public function getData()
    {
        $data = parent::getData();

        $data['capture'] = false;

        return $data;
    }
}
