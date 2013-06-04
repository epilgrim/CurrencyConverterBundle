<?php

namespace Epilgrim\CurrencyConverterBundle\Model;

use Epilgrim\CurrencyConverterBundle\Model\CurrencyRateInterface;

interface RepositoryInterface
{
	public function get($code, \DateTime $date);

	public function add ($code, CurrencyRateInterface $rate);
}