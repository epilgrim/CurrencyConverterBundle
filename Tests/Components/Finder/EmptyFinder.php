<?php

namespace Epilgrim\CurrencyConverterBundle\Tests\Components\Finder;

use Epilgrim\CurrencyConverterBundle\Model\FinderInterface;

class EmptyFinder implements FinderInterface
{
	public function findAndAdd($code, \DateTime $date, RepositoryInterface $repository)
	{
		$value = $this->find($code, $date);
		$repository->add($code, $value);
		return $value;
	}


	public function initialize(RepositoryInterface $repository)
	{
	}

	public function find($code, \DateTime $date)
	{
	}
}