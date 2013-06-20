<?php

namespace Epilgrim\CurrencyConverterBundle\Entity;

use Epilgrim\CurrencyConverterBundle\Entity\AbstractMoney;
use Epilgrim\CurrencyConverterBundle\Entity\Currency;

/**
 * Currency
 *
 */
class LatestRateMoney extends AbstractMoney
{
    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var Epilgrim\CurrencyConverterBundle\Entity\Currency
     **/
    private $currency;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get the currency
     *
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * sets the currency
     * @param Currency $currency Currency
     */
    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * returns the latest rate
     * @return CurrencyRate
     */
    public function getRate(){
        return $this->getCurrency()->getRates()->last();
    }
}
