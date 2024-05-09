<?php

namespace App\Form;

use App\Entity\ActivationPlatform;
use App\Entity\Game;
use App\Entity\Offers;
use App\Entity\Platform;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OfferFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('game', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'name',
                'multiple' => false,
            ])
            ->add('edition')
            ->add('platform', EntityType::class, [
                'class' => Platform::class,
                'choice_label' => 'name',
                'multiple' => false,
            ])
            ->add('activationPlatform', EntityType::class, [
                'class' => ActivationPlatform::class,
                'choice_label' => 'name',
                'multiple' => false,
            ])
            ->add('discount')
            ->add('price')
            ->add('offerLink')
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offers::class,
        ]);
    }
}
