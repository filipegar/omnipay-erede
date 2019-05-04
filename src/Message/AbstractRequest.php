<?php

namespace Omnipay\Erede\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * Abstract Request
 *
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    protected $liveEndpoint = 'https://api.userede.com.br/erede/v1/transactions';
    protected $testEndpoint = 'https://api.userede.com.br/desenvolvedores/v1/transactions';
    private $urlSuffix = "";

    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    public function setAffiliation($value)
    {
        return $this->setParameter('affiliation', $value);
    }

    public function getSoftDescriptor()
    {
        $value = $this->stripAccents(str_replace(array('<', '>', '"', '\''), '',
            $this->getParameter('softDescriptor')));
        return $value;
    }

    private function stripAccents($str)
    {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'),
            'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }

    public function setSoftDescriptor($value)
    {
        return $this->setParameter('softDescriptor', $value);
    }

    public function setInstallments($value)
    {
        $value = intval($value);
        return $this->setParameter('installments', $value);
    }

    public function getInstallments()
    {
        return $this->getParameter('installments');
    }

    public function sendData($data)
    {
        $headers = [
            'Authorization' => 'Basic ' . base64_encode($this->getAffiliation() . ':' . $this->getKey()),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $url = $this->getEndpoint();

        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $url, $headers, json_encode($data));

        return $this->createResponse($httpResponse->getBody()->getContents(), $httpResponse->getHeaders());
    }

    public function getAffiliation()
    {
        return $this->getParameter('affiliation');
    }

    public function getKey()
    {
        return $this->getParameter('key');
    }

    protected function getEndpoint()
    {
        $url = boolval($this->getTestMode()) ? $this->testEndpoint : $this->liveEndpoint;

        return "{$url}/{$this->getUrlSuffix()}";
    }

    public function getUrlSuffix()
    {
        return $this->urlSuffix;
    }

    public function setUrlSuffix($suffix)
    {
        $this->urlSuffix = $suffix;
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }

    protected function getBaseData()
    {
        return [
            'origin' => 1,
            'capture' => true,
            'kind' => 'credit',
            'reference' => null,
            'amount' => 0,
            'cardHolderName' => null,
            'cardNumber' => null,
            'expirationMonth' => null,
            'expirationYear' => null,
            'securityCode' => null,
            'softDescriptor' => null,
        ];
    }
}
