<?php

namespace App\Form;

use App\Entity\Support;
use App\Repository\ValueRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', NULL, [
                'label' => 'Value :',
                'required' => true,
                'query_builder' => function (ValueRepository $er) {
                    return $er->createQueryBuilder('v')
                        ->orderBy('v.name', 'ASC');
                },
            ])
            ->add('adresse')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Support::class,
        ]);
    }
}
