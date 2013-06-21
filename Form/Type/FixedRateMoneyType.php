<?php
// src/Acme/TaskBundle/Form/Type/IssueSelectorType.php
namespace Epilgrim\CurrencyConverterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Epilgrim\CurrencyConverterBundle\Form\DataTransformer\CurrencyToFixedRateTransformer;
use Epilgrim\CurrencyConverterBundle\Model\RepositoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FixedRateMoneyType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $om;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', 'number')
            ->add('rate', 'epilgrim_rate_money')        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    public function getParent()
    {
        return 'form';
    }

    public function getName()
    {
        return 'epilgrim_fixed_rate_money';
    }
}