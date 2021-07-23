<?php

namespace App\Form;

use App\Entity\Link;
use App\Entity\Subcategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subcategory', EntityType::class, [
                'class' => Subcategory::class,
                'choice_label' => function ($subcategory) {
                    return $subcategory->getCategory()->getName() . ' - ' . $subcategory->getName();
                }
            ])
            ->add('name')
            ->add('link')
            ->add('statue')
            ->add('Top')

            ->add('mining')
            ->add('ptc')
            ->add('shortlink')
            ->add('game')
            ->add('auto')
            ->add('captcha')
            ->add('video')
            ->add('faucet')

            ->add('timer')
            ->add('payment')
            ->add('minimunpayment')
            ->add('value')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Link::class,
        ]);
    }
}
