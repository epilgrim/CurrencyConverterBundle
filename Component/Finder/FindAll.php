<?php

namespace Epilgrim\CurrencyConverterBundle\Component\Finder;

use Epilgrim\CurrencyConverterBundle\Model\FinderInterface;
use Epilgrim\CurrencyConverterBundle\Model\RepositoryInterface;
use Epilgrim\CurrencyConverterBundle\Entity\CurrencyRepository;

class FindAll implements FinderInterface
{
	protected $currencyRepository;

	public function __construct(CurrencyRepository $repo)
	{
		$this->currencyRepository = $repo;
	}

	public function findAndAdd($code, \DateTime $date, RepositoryInterface $repository)
	{
	}


	public function initialize(RepositoryInterface $repository)
	{
		$currencies = $this->currencyRepository->getAll();
		foreach ($currencies as $currency){
			foreach ($currency->getRates() as $rate){
				$repository->add($currency->getCode(), $rate);
			}
		}
	}
}
