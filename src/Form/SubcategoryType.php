<?php

namespace App\Form;

use App\Entity\Subcategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubcategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category',NULL, [
                'label' => 'Catégorie :'
            ])
            ->add('name',TextType::class, [
                'label' => 'Nom :'
            ])
            ->add('logo',TextType::class, [
                'label' => 'Logo :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subcategory::class,
        ]);
    }
}
