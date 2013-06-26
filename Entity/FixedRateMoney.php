<?php

namespace Epilgrim\CurrencyConverterBundle\Entity;

use Epilgrim\CurrencyConverterBundle\Entity\AbstractMoney;
use Epilgrim\CurrencyConverterBundle\Entity\CurrencyRate;

/**
 * Currency
 *
 */
class FixedRateMoney extends AbstractMoney
{
    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var datetime
     *
     */
    private $date;

    /**
     * @var Epilgrim\CurrencyConverterBundle\Entity\CurrencyRate
     **/
    private $rate;

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
     * get the date of the application of the rates.
     * @return datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param datetime $date
     */
    public function setDate(\Datetime $date = NULL)
    {
        if ($date != $this->getDate()){
            $this->date = $date;
        }
        return $this;
    }

    /**
     * get the rate
     *
     * @return CurrencyRate
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * sets the rate
     * @param CurrencyRate $rate Rate
     */
    public function setRate(CurrencyRate $rate)
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * returns the currency
     * @return Currency
     */
    public function getCurrency(){
        return $this->getRate()->getCurrency();
    }
}
