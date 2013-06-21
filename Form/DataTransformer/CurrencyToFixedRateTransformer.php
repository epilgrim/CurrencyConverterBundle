<?php
// src/Acme/TaskBundle/Form/DataTransformer/IssueToNumberTransformer.php
namespace Epilgrim\CurrencyConverterBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Epilgrim\CurrencyConverterBundle\Model\RepositoryInterface;
use Epilgrim\CurrencyConverterBundle\Entity\FixedRateMoney;

class CurrencyToFixedRateTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(RepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     *
     * @param  Issue|null $rate
     * @return string
     */
    public function transform($rate)
    {
        return $rate;
    }

    /**
     * Transforms the currency and date to the corresponding Rate
     *
     * @param  array $data
     *
     * @return CurrencyRate
     *
     */
    public function reverseTransform($data)
    {
        return $this->currencyRepository->get($data['currency']->getCode(), $data['date']);
    }
}