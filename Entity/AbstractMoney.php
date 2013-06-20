<?php

namespace Epilgrim\CurrencyConverterBundle\Entity;

/**
 *
 */
abstract class AbstractMoney
{
    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var float
     *
     */
    private $value;

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
     * Set value
     *
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the associated Currency
     * @return  Currency
     */
    abstract function getCurrency();

    /**
     * Get the associated Rate
     * @return  CurrencyRate
     */
    abstract function getRate();
}
