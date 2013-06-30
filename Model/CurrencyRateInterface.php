<?php

namespace Epilgrim\CurrencyConverterBundle\Model;

interface CurrencyRateInterface{

	public function getDateFrom();

	public function getDateTo();

	public function getRate();

	public function getCurrency();
}