<?php
namespace Epilgrim\CurrencyConverterBundle\Component\Container;

use Epilgrim\CurrencyConverterBundle\Model\ContainerInterface;
use Epilgrim\CurrencyConverterBundle\Model\CurrencyRateInterface;
use Epilgrim\CurrencyConverterBundle\Model\FinderInterface;
use Epilgrim\CurrencyConverterBundle\Exception\NoRateFoundException;

/**
 * Container of Rates for a given currency
 */
abstract class Container implements ContainerInterface {

	protected $finder;

	public function __construct(FinderInterface $finder)
	{
		$this->finder = $finder;
		$this->finder->initialize($this);
	}

	public function get($code, \DateTime $date){
		$rate = $this->find($code, $date);
		if (null === $rate)
		{
			$rate = $this->finder->findAndAdd($code, $date, $this);
		}

		if (null === $rate)
		{
			throw new NoRateFoundException("Rate not found");
		}

		return $rate;
	}

	/**
	 * Returns the corresponding rate
	 * @param  string   $code Code of the currency
	 * @param  \DateTime $date
	 * @return CurrencyRateInterface
	 */
	abstract protected function find ($code, \DateTime $date);

	/**
	 * Adds a new rate to the Container
	 * @param [type]                $code [description]
	 * @param CurrencyRateInterface $rate [description]
	 */
	abstract public function add ($code, CurrencyRateInterface $rate);

}