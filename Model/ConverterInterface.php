<?php

namespace Epilgrim\CurrencyConverterBundle\Model;

interface ConverterInterface
{
	/**
	 * Converts the value of a given currency to another, at a given point in time
	 * @param  float     $value         amount
	 * @param  string    $currencyFrom  iso code of the currency in wich the amount is
	 * @param  string    $currencyTo    iso code of the currency in wich we want the amount
	 * @param  \DateTime $date          Date of the exchange rate we want to apply
	 * @return float                    Converted Amount
	 */
	public function convert($value, $currencyFrom, $currencyTo, \DateTime $date);
}
