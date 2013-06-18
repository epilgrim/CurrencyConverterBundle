<?php

namespace Epilgrim\CurrencyConverterBundle\Entity;

use Epilgrim\CurrencyConverterBundle\Model\CurrencyInterface;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Currency
 *
 */
class Currency implements CurrencyInterface
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
    private $code;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var  decimal
     **/
    private $rates;

    public function __construct() {
        $this->rates = new ArrayCollection();
    }

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
     * Set code
     *
     * @param string $code
     * @return Currency
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Currency
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * get the rates list
     * @return ArrayCollection [description]
     */
    public function getRates()
    {
        return $this->rates;
    }

    /**
     * sets the rates
     * @param ArrayCollection $rates
     */
    public function setRates(ArrayCollection $rates)
    {
        $this->rates = $rates;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
