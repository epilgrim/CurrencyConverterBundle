<?php

namespace Epilgrim\CurrencyConverterBundle\Entity;

use Epilgrim\CurrencyConverterBundle\Entity\AbstractMoney;
use Epilgrim\CurrencyConverterBundle\Entity\CurrencyRate;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Currency
 *
 */
class FixedRateMoney extends AbstractMoney
{
    /**
     * @var datetime
     * @Assert\NotNull()
     */
    private $date;

    /**
     * @var Epilgrim\CurrencyConverterBundle\Entity\CurrencyRate
     * @Assert\NotNull()
     **/
    private $rate;

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
        if (null !== $this->getRate()){
            return $this->getRate()->getCurrency();
        }
    }
}
