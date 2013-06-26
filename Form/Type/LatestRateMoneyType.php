<?php
// src/Acme/TaskBundle/Form/Type/IssueSelectorType.php
namespace Epilgrim\CurrencyConverterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Epilgrim\CurrencyConverterBundle\Form\DataTransformer\CurrencyToFixedRateTransformer;
use Epilgrim\CurrencyConverterBundle\Model\RepositoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LatestRateMoneyType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $om;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', 'number')
            ->add('currency', 'entity', array(
                'class' => 'Epilgrim\CurrencyConverterBundle\Entity\Currency'
                ))
        ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => '\Epilgrim\CurrencyConverterBundle\Entity\LatestRateMoney'
        ));
    }

    public function getParent()
    {
        return 'form';
    }

    public function getName()
    {
        return 'epilgrim_latest_rate_money';
    }
}