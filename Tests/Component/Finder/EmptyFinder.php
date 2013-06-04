<?php

namespace Epilgrim\CurrencyConverterBundle\Tests\Component\Finder;

use Epilgrim\CurrencyConverterBundle\Model\FinderInterface;
use Epilgrim\CurrencyConverterBundle\Model\RepositoryInterface;

class EmptyFinder implements FinderInterface
{
	public function findAndAdd($code, \DateTime $date, RepositoryInterface $repository)
	{
		$value = $this->find($code, $date);
		if (null !== $value)
		{
			$repository->add($code, $value);
		}
		return $value;
	}


	public function initialize(RepositoryInterface $repository)
	{
	}

	public function find($code, \DateTime $date)
	{
	}
}