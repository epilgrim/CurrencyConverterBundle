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
   public function __construct(RepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new CurrencyToFixedRateTransformer($this->currencyRepository);
        $builder
            ->addViewTransformer($transformer)
            ->add('value', 'number')
            ->add('date', 'date', array('widget' => 'single_text'))
            ->add('currency', 'entity', array(
                'class' => 'Epilgrim\CurrencyConverterBundle\Entity\Currency',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => '\Epilgrim\CurrencyConverterBundle\Entity\FixedRateMoney'
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