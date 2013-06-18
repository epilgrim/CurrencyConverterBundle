<?php

namespace Epilgrim\CurrencyConverterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Epilgrim\CurrencyConverterBundle\Model\CurrencyRateInterface;
use Epilgrim\CurrencyConverterBundle\Model\CurrencyInterface;

/**
 * Currency
 *
 */
class CurrencyRate implements CurrencyRateInterface
{
    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $dateFrom;

    /**
     * @var string
     *
     */
    private $dateTo;

    /**
     * @var float
     *
     */
    private $rate;

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
     * get Starting validity date of the rate
     * @return datetime
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * sets the starting validity date of the rate
     * @param datetime $dateFrom Start Date
     */
    public function setDateFrom(\Datetime $dateFrom)
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * get end validity date of the rate
     * @return datetime
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * sets the end validity date of the rate
     * @param datetime $dateFrom End Date
     */
    public function setDateTo(\Datetime $dateTo)
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    /**
     * get the rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * sets the rate
     * @param float $rate Rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * returns the currency
     * @return \Epilgrim\CurrencyBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
    /**
     * Sets the currency
     * @param \Epilgrim\CurrencyBundle\Entity\Currency $currency Currency
     */
    public function setCurrency(CurrencyInterface $currency)
    {
        $this->currency = $currency;
        return $this;
    }
}
