<?php

namespace Epilgrim\CurrencyConverterBundle\Tests\Fixtures;

use Epilgrim\CurrencyConverterBundle\Entity\Currency;
use Epilgrim\CurrencyConverterBundle\Entity\CurrencyRate;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
* Tests fixtures class.
*
*/
class CurrencyData implements FixtureInterface
{
    /**
* @see Doctrine\Common\DataFixtures.FixtureInterface::load()
*/
    public function load(ObjectManager $manager)
    {

        foreach ($this->getData() as $currencyData)
        {
            $currency = new Currency();
            $currency
                ->setCode($currencyData['code'])
                ->setName($currencyData['name']);
            foreach ($currencyData['rates'] as $rateData)
            {
                $rate = new CurrencyRate();
                $rate->setDateFrom($rateData['dateFrom'])
                    ->setDateTo($rateData['dateTo'])
                    ->setRate($rateData['rate']);
                $currency->addRate($rate);

                $manager->persist($rate);
            }
            $manager->persist($currency);
        }

        $manager->flush();
    }

    protected function getData()
    {
        return array(
            array(
                'name' => 'American Dolar',
                'code' => 'USD',
                'rates' => array(
                    array(
                        'dateFrom'=> new \DateTime('2000-01-01'),
                        'dateTo'=> new \DateTime('2010-01-01'),
                        'rate' => 1.5,
                    ),
                    array(
                        'dateFrom'=> new \DateTime('2010-01-01'),
                        'dateTo'=> new \DateTime('2015-12-31'),
                        'rate' => 2,
                    ),
                )
            ),
            array(
                'name' => 'Argentinean Peso',
                'code' => 'ARS',
                'rates' => array(
                    array(
                        'dateFrom'=> new \DateTime('2000-01-01'),
                        'dateTo'=> new \DateTime('2010-01-01'),
                        'rate' => 6,
                    ),
                    array(
                        'dateFrom'=> new \DateTime('2010-01-01'),
                        'dateTo'=> new \DateTime('2015-12-31'),
                        'rate' => 10,
                    ),
                )
            ),
        );
    }
}