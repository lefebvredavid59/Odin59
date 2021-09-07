<?php

namespace App\Form;

use App\Entity\Value;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture', FileType::class, [
                'label' => 'Image :',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Choisir une image',
                ],
            ])
            ->add('name',TextType::class, [
                'label' => 'Nom :'
            ])
            ->add('site',TextType::class, [
                'label' => 'Site :'
            ])
            ->add('symbol',TextType::class, [
                'label' => 'Symbole :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Value::class,
        ]);
    }
}
