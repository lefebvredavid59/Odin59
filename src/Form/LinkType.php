<?php

namespace App\Form;

use App\Entity\Link;
use App\Entity\Subcategory;
use App\Entity\Value;
use App\Repository\ValueRepository;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subcategory', EntityType::class, [
                'label' => 'Catégorie :',
                'class' => Subcategory::class,
                'choice_label' => function ($subcategory) {
                    return $subcategory->getCategory()->getName() . ' - ' . $subcategory->getName();
                }
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom :'
            ])
            ->add('link', TextType::class, [
                'label' => 'Lien :'
            ])
            ->add('timer', TextType::class, [
                'label' => 'Timer :'
            ])
            ->add('payment', TextType::class, [
                'label' => 'Type Paiement :'
            ])
            ->add('minimunpayment', TextType::class, [
                'label' => 'Minimun Paiement :'
            ])
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
            ->add('value', NULL, [
                'label' => 'Value :',
                'query_builder' => function (ValueRepository $er) {
                    return $er->createQueryBuilder('v')
                        ->orderBy('v.name', 'ASC');
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Link::class,
        ]);
    }
}
