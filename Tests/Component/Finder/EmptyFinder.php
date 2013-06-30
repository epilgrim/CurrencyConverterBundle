<?php

namespace Epilgrim\CurrencyConverterBundle\Tests\Component\Finder;

use Epilgrim\CurrencyConverterBundle\Model\FinderInterface;
use Epilgrim\CurrencyConverterBundle\Model\ContainerInterface;

class EmptyFinder implements FinderInterface
{
	public function findAndAdd($code, \DateTime $date, ContainerInterface $repository)
	{
		$value = $this->find($code, $date);
		if (null !== $value)
		{
			$repository->add($code, $value);
		}
		return $value;
	}


	public function initialize(ContainerInterface $repository)
	{
	}

	public function find($code, \DateTime $date)
	{
	}
}