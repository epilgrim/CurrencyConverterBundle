<?php

namespace Epilgrim\CurrencyConverterBundle\Tests\Component\Finder;

use Epilgrim\CurrencyConverterBundle\Tests\BaseFunctionalTestCase;
use Epilgrim\CurrencyConverterBundle\Component\Finder\FindAll;
use Epilgrim\CurrencyConverterBundle\Component\Repository\SimpleRepository;
use Epilgrim\CurrencyConverterBundle\Tests\Fixtures\CurrencyData;

class FindAllTest extends BaseFunctionalTestCase
{
    private $em;

    public function setUp()
    {
        $this->em = $this->getMockSqliteEntityManager();
        $this->createSchema($this->em);
    }

    public function testDataIsLoaded()
    {
        $this->loadFixtures($this->em);

        $repository = $this->em->getRepository('Epilgrim\CurrencyConverterBundle\Entity\Currency');

        $rates = $repository->getAll();
        $this->assertEquals(CurrencyData::TOTAL_RATES_IN_FIXTURE, count($rates), 'All the rates loaded at once');
    }

    public function testFindAll()
    {
        $this->loadFixtures($this->em);

        $currencyRepository = $this->em->getRepository('Epilgrim\CurrencyConverterBundle\Entity\Currency');

        $finder = new FindAll($currencyRepository);

        //$repository = new SimpleRepository($finder);
        $repository = $this->getMockBuilder('Epilgrim\CurrencyConverterBundle\Component\Repository\SimpleRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $repository->expects($this->exactly(CurrencyData::TOTAL_RATES_IN_FIXTURE))
             ->method('add')
             ->will($this->returnValue(true));
        $finder->initialize($repository);

    }

}

