<?php

namespace Epilgrim\CurrencyConverterBundle\Component\Finder;

use Epilgrim\CurrencyConverterBundle\Model\FinderInterface;
use Epilgrim\CurrencyConverterBundle\Model\ContainerInterface;
use Epilgrim\CurrencyConverterBundle\Entity\CurrencyRepository;

class FindAll implements FinderInterface
{
	protected $currencyRepository;

	public function __construct(CurrencyRepository $repo)
	{
		$this->currencyRepository = $repo;
	}

	public function findAndAdd($code, \DateTime $date, ContainerInterface $repository)
	{
	}


	public function initialize(ContainerInterface $repository)
	{
		$rates = $this->currencyRepository->getAll();
		foreach ($rates as $rate){
			$repository->add($rate->getCurrency()->getCode(), $rate);
		}
	}
}
