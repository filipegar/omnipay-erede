<?php

namespace Omnipay\Erede\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Response
 */
class Response extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = json_decode($data);
    }

    public function isSuccessful()
    {
        if (strstr($this->getRequest()->getUrlSuffix(), 'refunds')) {
            return isset($this->data->returnCode) && ($this->data->returnCode === "359" || $this->data->returnCode === "360");
        }

        return isset($this->data->returnCode) && $this->data->returnCode === "00";
    }

    public function getTransactionReference()
    {
        if (isset($this->data->tid)) {
            return $this->data->tid;
        }
    }

    public function getCode()
    {
        if (isset($this->data->returnCode)) {
            return $this->data->returnCode;
        }
    }

    public function getMessage()
    {
        if (isset($this->data->returnMessage)) {
            return $this->data->returnMessage;
        }
    }
}
