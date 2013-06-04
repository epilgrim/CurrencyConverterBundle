<?php
namespace Epilgrim\CurrencyConverterBundle\Tests\Repository;

use Epilgrim\CurrencyConverterBundle\Component\Repository\SimpleRepository;
use Epilgrim\CurrencyConverterBundle\Entity\Currency;
use Epilgrim\CurrencyConverterBundle\Entity\CurrencyRate;
use Epilgrim\CurrencyConverterBundle\Tests\Components\Finder\EmptyFinder;

class SimpleRepositoryTest extends \PHPUnit_Framework_TestCase
{

    public function testReturnsCorrectRate()
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

        $finder = $this->getMock('\Epilgrim\CurrencyConverterBundle\Tests\Components\Finder\EmptyFinder', 'find');
        $repo = new SimpleRepository($finder);
        $repo->add('USD', $rate1);
        $repo->add('USD', $rate2);

        $this->assertSame($rate1, $repo->get('USD', new \DateTime('2011-01-01')), 'First currency in the middle of validity returned correctly');
        $this->assertSame($rate2, $repo->get('USD', new \DateTime('2013-01-01')), 'Second currency in the middle of validity returned correctly');
        $this->assertSame($rate2, $repo->get('USD', new \DateTime('2012-12-31')), 'Currency in the high top of validity returned correctly');
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionIfNotManagedCurrency()
    {
        $finder = $this->getMock('\Epilgrim\CurrencyConverterBundle\Tests\Components\Finder\EmptyFinder', 'find');
        $repo = new SimpleRepository($finder);
        $this->finder->expects($this->once())
                 ->method('update')
                 ->with($this->equalTo('something'));
        $repo->get('USD', new \DateTime('2011-01-01'));
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionIfNotRateForCurrency()
    {
        $finder = $this->getMock('\Epilgrim\CurrencyConverterBundle\Tests\Components\Finder\EmptyFinder', 'find');
        $repo = new SimpleRepository($finder);
        $rate1 = new CurrencyRate();
        $rate1
            ->setDateFrom( new \DateTime('2010-01-01'))
            ->setDateTo( new \DateTime('2012-12-31'))
            ->setRate( 1.5 );
        $repo->add('USD', $rate1);

        $repo->get('USD', new \DateTime('2013-01-01'));
    }

    public function testFinderGetsCalledIfNoRate()
    {

        $finder = $this->getMock('\Epilgrim\CurrencyConverterBundle\Tests\Components\Finder\EmptyFinder', 'find');
        $repo = new SimpleRepository($finder);

        $this->assertSame($rate1, $repo->get('USD', new \DateTime('2011-01-01')), 'First currency in the middle of validity returned correctly');
    }
}