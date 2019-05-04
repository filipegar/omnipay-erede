<?php

namespace Omnipay\Erede;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Exception\BadMethodCallException;

/**
 * Skeleton Gateway
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'e.Rede';
    }

    public function getDefaultParameters()
    {
        return array(
            'affiliation' => null,
            'key' => null,
            'testMode' => false,
        );
    }

    public function getKey()
    {
        return $this->getParameter('key');
    }

    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    public function getAffiliation()
    {
        return $this->getParameter('affiliation');
    }

    public function setAffiliation($value)
    {
        return $this->setParameter('affiliation', $value);
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function authorize(array $parameters = [])
    {
        return $this->createRequest(\Omnipay\Erede\Message\AuthorizeRequest::class, $parameters);
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function completeAuthorize(array $parameters = [])
    {
        throw new BadMethodCallException("Not implemented.");
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function capture(array $parameters = [])
    {
        return $this->createRequest(\Omnipay\Erede\Message\CaptureRequest::class, $parameters);
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest(\Omnipay\Erede\Message\PurchaseRequest::class, $parameters);
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function completePurchase(array $parameters = [])
    {
        throw new BadMethodCallException("Not implemented.");
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function refund(array $parameters = [])
    {
        return $this->createRequest(\Omnipay\Erede\Message\RefundRequest::class, $parameters);
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function createCard(array $parameters = [])
    {
        throw new BadMethodCallException("Not supported by gateway.");
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function updateCard(array $parameters = [])
    {
        throw new BadMethodCallException("Not supported by gateway.");
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function deleteCard(array $parameters = [])
    {
        throw new BadMethodCallException("Not supported by gateway.");
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function void(array $parameters = [])
    {
        throw new BadMethodCallException("Not supported by gateway.");
    }
}
