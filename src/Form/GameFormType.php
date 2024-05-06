<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Developers;
use App\Entity\Platform;
use App\Entity\NEditors;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('Platforms', EntityType::class, [
                'class' => Platform::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Plateform',
                
            ])
            ->add('developers', EntityType::class, [
                'class' => Developers::class,
                'choice_label' => 'developerName',
                'label' => 'Development Team',
                
            ])
            ->add('nEditors', EntityType::class, [
                'class' => NEditors::class,
                'choice_label' => 'name',
                'label' => 'Editor',
                
            ])
            ->add('releaseDate')
            
            ->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
