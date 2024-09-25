<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Event;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('date')
            ->add('club', EntityType::class, [
                'class' => Club::class,
                'choices' => $options['clubs'],  // Utilisation des clubs filtrés passés en option
                'choice_label' => 'name',
                'placeholder' => 'Choose a club',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'clubs' => [],  // Define 'clubs' option with a default empty array
        ]);
    }
}
