<?php
// src/Acme/TaskBundle/Form/Type/IssueSelectorType.php
namespace Epilgrim\CurrencyConverterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Epilgrim\CurrencyConverterBundle\Form\DataTransformer\CurrencyToFixedRateTransformer;
use Epilgrim\CurrencyConverterBundle\Model\RepositoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RateMoneyType extends AbstractType
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

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new CurrencyToFixedRateTransformer($this->currencyRepository);
        $builder->addViewTransformer($transformer);
        $builder
            ->add('date', 'date')
            ->add('currency', 'entity', array(
                'class' => 'Epilgrim\CurrencyConverterBundle\Entity\Currency'
                ))
        ;
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
        return 'epilgrim_rate_money';
    }
}