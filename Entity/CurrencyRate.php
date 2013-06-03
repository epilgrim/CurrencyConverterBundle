<?php

namespace Epilgrim\CurrencyConverterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CurrencyRate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="date_from", type="datetime")
     */
    private $dateFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="date_to", type="datetime")
     */
    private $dateTo;

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="float")
     */
    private $rate;

    /**
     * @ManyToOne(targetEntity="\Epilgrim\CurrencyBundle\Entity\Currency", inversedBy="rates")
     * @JoinColumn(name="currency_id", referencedColumnName="id")
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
    public function setDateTo(\Datetime $dateFrom)
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
    public function setCurrency(\Epilgrim\CurrencyBundle\Entity\Currency $currency)
    {
        $this->currency = $currency;
        return $this;
    }
}
