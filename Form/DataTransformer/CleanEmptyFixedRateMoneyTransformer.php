<?php
namespace Epilgrim\CurrencyConverterBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Epilgrim\CurrencyConverterBundle\Model\RepositoryInterface;
use Epilgrim\CurrencyConverterBundle\Entity\FixedRateMoney;

class CleanEmptyFixedRateMoneyTransformer implements DataTransformerInterface
{
    /**
     *
     * @param  FixedRateMoney|null $fixedRateMoney
     * @return FixedfixedRateMoneyMoney
     */
    public function transform($fixedRateMoney)
    {
        return $fixedRateMoney;
    }

    /**
     * Transforms the currency and date to the corresponding Rate
     *
     * @param  array $data
     *
     * @return CurrencyRate
     *
     */
    public function reverseTransform($fixedRateMoney)
    {
        if (null !== $fixedRateMoney->getDate() || null !== $fixedRateMoney->getValue()){
            return $fixedRateMoney;
        }
        return null;
    }
}
