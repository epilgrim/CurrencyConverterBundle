<?php
// src/Acme/TaskBundle/Form/Type/IssueSelectorType.php
namespace Epilgrim\CurrencyConverterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Epilgrim\CurrencyConverterBundle\Model\RepositoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Epilgrim\CurrencyConverterBundle\Form\DataTransformer\CleanEmptyFixedRateMoneyTransformer;

class FixedRateMoneyType extends AbstractType
{
   public function __construct(RepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new CleanEmptyFixedRateMoneyTransformer();
        $builder
            ->addViewTransformer($transformer)
            ->add('value', 'number')
            ->add('date', 'date', array('widget' => 'single_text'))
            ->add('currency', 'entity', array(
                'class' => 'Epilgrim\CurrencyConverterBundle\Entity\Currency',
                'mapped' => false,
            ))
        ;

        $currencyRepository = $this->currencyRepository;
        $builder->addEventListener(
            FormEvents::SUBMIT,
            function(FormEvent $event) use ($currencyRepository){
                $form = $event->getForm();
                $data = $event->getData();
                if (null !== $form->get('currency')->getData()->getCode() && null !== $form->get('date')->getData()){
                    $data->setRate($currencyRepository->get($form->get('currency')->getData()->getCode(), $form->get('date')->getData()));
                }
            }
        );
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($currencyRepository){
                $form = $event->getForm();
                $data = $event->getData();
                if (null !== $data) {
                    $form->get('currency')->setData($data->getCurrency());
                }
            }
        );
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