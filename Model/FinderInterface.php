<?php

namespace Epilgrim\CurrencyConverterBundle\Model;

use Epilgrim\CurrencyConverterBundle\Model\ContainerInterface;

interface FinderInterface
{
	/**
	 * Finds the Rate, adds it to the repository and returns it.
	 * It may optionally add more than one rate to the repository. But it must
	 * return always the requested rate
	 * @param  string              $code       iso code of the currency
	 * @param  \DateTime           $date       date to find the corresponding rate
	 * @param  ContainerInterface $repository
	 * @return null|Epilgrim\CurrencyConverterBundle\Model\CurrencyRateInterface
	 */
	public function findAndAdd($code, \DateTime $date, ContainerInterface $repository);

	/**
	 * Initializes the repository. May load default rates.
	 * @param  ContainerInterface $repository [description]
	 * @return [type]                          [description]
	 */
	public function initialize(ContainerInterface $repository);
}