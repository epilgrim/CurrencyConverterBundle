<?php

namespace Epilgrim\CurrencyConverterBundle\Component\Converter;

use Epilgrim\CurrencyConverterBundle\Model\RepositoryInterface;
use Epilgrim\CurrencyConverterBundle\Model\ConverterInterface;

class Converter implements ConverterInterface
{
	protected $default;
	protected $repository;

	public function __construct($default, RepositoryInterface $repository)
	{
		$this->default = $default;
		$this->repository = $repository;
	}

	public function convert($value, $currencyFrom, $currencyTo, \DateTime $date){
		if ($currencyFrom != $currencyTo)
		{
			if ($currencyFrom <> $this->getDefaultCurrency())
			{
				$value /= $this->getRepository()->get($currencyFrom, $date)->getRate();
			}
			if ($currencyTo <> $this->getDefaultCurrency())
			{
				$value *= $this->getRepository()->get($currencyTo, $date)->getRate();
			}
		}
		return $value;
	}

	public function getDefaultCurrency(){
		return $this->default;
	}

	private function getRepository()
	{
		return $this->repository;
	}
}
