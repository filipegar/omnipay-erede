<?php


namespace Omnipay\Erede\Message;


class GenericTransaction extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'card');
        $this->getCard()->validate();

        $data = $this->getBaseData();
        $data['reference'] = $this->getTransactionId();
        $data['amount'] = $this->getAmountInteger();

        $card = $this->getCard();

        $data['cardHolderName'] = $card->getName();
        $data['cardNumber'] = $card->getNumber();
        $data['expirationMonth'] = $card->getExpiryMonth();
        $data['expirationYear'] = $card->getExpiryYear();
        $data['securityCode'] = $card->getCvv();

        if ($this->getSoftDescriptor()) {
            $data['softDescriptor'] = $this->getSoftDescriptor();
        }

        if ($this->getParameter('installments')) {
            $data['installments'] = $this->getParameter('installments');
        }

        return $data;
    }
}
