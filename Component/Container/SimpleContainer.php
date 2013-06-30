<?php
namespace Epilgrim\CurrencyConverterBundle\Component\Container;

use Epilgrim\CurrencyConverterBundle\Model\CurrencyRateInterface;
use Epilgrim\CurrencyConverterBundle\Component\Container\Container;

class SimpleContainer extends Container
{

	private $list = array();

	protected function find ($code, \DateTime $date)
	{
		if (array_key_exists($code, $this->list))
		{
			foreach  ($this->list[$code] as $rate)
			{
				if ($date >= $rate->getDateFrom() && $date < $rate->getDateTo()){
					return $rate;
				}
			}
		}
	}

	/**
	 * Adds a new Rate to the collection
	 * @param [type]                $code [description]
	 * @param CurrencyRateInterface $rate [description]
	 */
	public function add ($code, CurrencyRateInterface $rate)
	{
		$this->list[$code][] = $rate;
	}

}
