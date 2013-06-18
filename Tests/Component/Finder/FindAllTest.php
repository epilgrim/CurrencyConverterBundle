<?php

namespace Epilgrim\CurrencyConverterBundle\Tests\Component\Finder;

use Epilgrim\CurrencyConverterBundle\Tests\BaseFunctionalTestCase;

class FindAllTest extends BaseFunctionalTestCase
{
    private $em;

    public function setUp()
    {
        $this->em = $this->getMockSqliteEntityManager();
        $this->createSchema($this->em);
        $this->loadFixtures($this->em);
    }

    public function testDataIsLoaded()
    {
        $repository = $this->em->getRepository('Epilgrim\CurrencyConverterBundle\Entity\Currency');
        $this->assertGreaterThan(0, count($repository->findAll()), 'The fixtures are loaded');

        $rates = $repository->getAll();
        $this->assertEquals(2, count($rates), 'All the rates loaded at once');
    }
/*
    public function testCreateEcbAdapter()
    {
        $factory = new AdapterFactory($this->em, 'EUR', array('EUR', 'USD'), self::CURRENCY_ENTITY);
        $adapter = $factory->createEcbAdapter();

        $this->assertInstanceOf('Lexik\Bundle\CurrencyBundle\Adapter\EcbCurrencyAdapter', $adapter);
        $this->assertEquals('EUR', $adapter->getDefaultCurrency());
        $this->assertEquals(array('EUR', 'USD'), $adapter->getManagedCurrencies());
        $this->assertEquals(0, count($adapter));
    }

    public function testCreateDoctrineAdapter()
    {

        $factory = new AdapterFactory($this->em, 'USD', array('EUR'), self::CURRENCY_ENTITY);
        $adapter = $factory->createDoctrineAdapter();

        $this->assertInstanceOf('Lexik\Bundle\CurrencyBundle\Adapter\DoctrineCurrencyAdapter', $adapter);
        $this->assertEquals('USD', $adapter->getDefaultCurrency());
        $this->assertEquals(array('EUR'), $adapter->getManagedCurrencies());
        $this->assertEquals(2, count($adapter));
    }
*/

}

