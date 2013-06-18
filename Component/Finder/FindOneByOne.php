<?php

namespace Epilgrim\CurrencyConverterBundle\Component\Finder;

use Epilgrim\CurrencyConverterBundle\Model\FinderInterface;
use Epilgrim\CurrencyConverterBundle\Model\RepositoryInterface;
use Epilgrim\CurrencyConverterBundle\Entity\CurrencyRepository;

class FindOneByOne implements FinderInterface
{
	protected $currencyRepository;

	public function __construct(CurrencyRepository $repo)
	{
		$this->currencyRepository = $repo;
	}

	public function findAndAdd($code, \DateTime $date, RepositoryInterface $repository)
	{
		$rates = $this->currencyRepository->findByCodeAndDate($code, $date);
		foreach ($rates as $rate){
			$repository->add($rate->getCurrency()->getCode(), $rate);
			return $rate;
		}
	}


	public function initialize(RepositoryInterface $repository)
	{
	}
}
