<?php

namespace Epilgrim\CurrencyConverterBundle\Model;

use Epilgrim\CurrencyConverterBundle\Model\RepositoryInterface;

interface FinderInterface
{
	/**
	 * Finds the Rate, adds it to the repository and returns it
	 * @param  string              $code       iso code of the currency
	 * @param  \DateTime           $date       date to find the corresponding rate
	 * @param  RepositoryInterface $repository
	 * @return null|Epilgrim\CurrencyConverterBundle\Model\CurrencyRateInterface
	 */
	public function findAndAdd($code, \DateTime $date, RepositoryInterface $repository);

	/**
	 * [initialize description]
	 * @param  RepositoryInterface $repository [description]
	 * @return [type]                          [description]
	 */
	public function initialize(RepositoryInterface $repository);
}