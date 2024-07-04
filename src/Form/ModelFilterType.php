<?php

namespace App\Form;

use App\Entity\Product\Marque;
use App\Filter\ModelFilter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('search', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Rechercher par nom',
                ],
                'required' => false,
            ])
            ->add('brands', EntityType::class, [
                'class' => Marque::class,
                'choice_label'  => 'name',
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('limit', ChoiceType::class, [
                'choices' => [
                    '9' => 9,
                    '18' => 18,
                    '36' => 36,
                ],
                'expanded' => false,
                'multiple' => false,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ModelFilter::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
