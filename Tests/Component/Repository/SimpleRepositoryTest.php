<?php
namespace Epilgrim\CurrencyConverterBundle\Tests\Repository;

use Epilgrim\CurrencyConverterBundle\Component\Repository\SimpleRepository;
use Epilgrim\CurrencyConverterBundle\Entity\Currency;
use Epilgrim\CurrencyConverterBundle\Entity\CurrencyRate;
use Epilgrim\CurrencyConverterBundle\Tests\Component\Finder\EmptyFinder;
use Epilgrim\CurrencyConverterBundle\Exception\NoRateFoundException;

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

        $finder = $this->getFinder();
        $repo = new SimpleRepository($finder);
        $repo->add('USD', $rate1);
        $repo->add('USD', $rate2);

        $this->assertSame($rate1, $repo->get('USD', new \DateTime('2011-01-01')), 'First currency in the middle of validity returned correctly');
        $this->assertSame($rate2, $repo->get('USD', new \DateTime('2013-01-01')), 'Second currency in the middle of validity returned correctly');
        $this->assertSame($rate2, $repo->get('USD', new \DateTime('2012-12-31')), 'Currency in the high top of validity returned correctly');
    }

    /**
     * @expectedException Epilgrim\CurrencyConverterBundle\Exception\NoRateFoundException
     */
    public function testExceptionIfNotManagedCurrency()
    {
        $finder = $this->getFinder();
        $repo = new SimpleRepository($finder);
        $repo->get('USD', new \DateTime('2011-01-01'));
    }

    /**
     * @expectedException Epilgrim\CurrencyConverterBundle\Exception\NoRateFoundException
     */
    public function testExceptionIfNotRateForCurrency()
    {
        $finder = $this->getFinder();
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
        $rate1 = new CurrencyRate();
        $rate1
            ->setDateFrom( new \DateTime('2010-01-01'))
            ->setDateTo( new \DateTime('2012-12-31'))
            ->setRate( 1.5 );

        $finder = $this->getMock('Epilgrim\CurrencyConverterBundle\Tests\Component\Finder\EmptyFinder', array('find'));
        $finder->expects($this->once())
            ->method('find')
            ->will($this->returnValue($rate1))
            ;
        $repo = new SimpleRepository($finder);
        $this->assertSame($rate1, $repo->get('USD', new \DateTime('2011-01-01')));
    }

    private function getFinder(){
        return $this->getMock('Epilgrim\CurrencyConverterBundle\Tests\Component\Finder\EmptyFinder');
    }
}