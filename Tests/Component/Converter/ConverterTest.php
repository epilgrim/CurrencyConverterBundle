<?php
namespace Epilgrim\CurrencyConverterBundle\Tests\Component\Converter;

use Epilgrim\CurrencyConverterBundle\Component\Repository\SimpleRepository;
use Epilgrim\CurrencyConverterBundle\Entity\CurrencyRate;
use Epilgrim\CurrencyConverterBundle\Component\Converter\Converter;


class ConverterTest extends \PHPUnit_Framework_TestCase
{

    public function testConverter()
    {

        $rate1 = new CurrencyRate();
        $rate1
            ->setDateFrom( new \DateTime('2010-01-01'))
            ->setDateTo( new \DateTime('2012-12-31'))
            ->setRate( 1.5 );

        $rate2 = new CurrencyRate();
        $rate2
            ->setDateFrom( new \DateTime('2012-12-31'))
            ->setDateTo( new \DateTime('2013-12-31'))
            ->setRate( 2 );
        $rate3 = new CurrencyRate();
        $rate3
            ->setDateFrom( new \DateTime('2010-12-31'))
            ->setDateTo( new \DateTime('2013-12-31'))
            ->setRate( 10 );

        $finder = $this->getMock('Epilgrim\CurrencyConverterBundle\Tests\Component\Finder\EmptyFinder');

        $repository = new SimpleRepository($finder);
        $repository->add('USD', $rate1);
        $repository->add('USD', $rate2);
        $repository->add('ARG', $rate3);

        $converter = new Converter('EUR', $repository);

        $this->assertEquals(2,$converter->convert('1', 'EUR', 'USD', new \DateTime()), 'Converts from default to another at current time', '0.0001');

        $this->assertEquals(0.5,$converter->convert('1', 'USD', 'EUR', new \DateTime()), 'Converts from another currency to default at current time', '0.0001');

        $this->assertEquals(5,$converter->convert('1', 'USD', 'ARG', new \DateTime()), 'Converts between different currencies at current time', 0.0001);

        $this->assertEquals(6.66666,$converter->convert('1', 'USD', 'ARG', new \DateTime('2011-01-01')), 'Converts between different currencies at past time', '0.0001');
    }

}