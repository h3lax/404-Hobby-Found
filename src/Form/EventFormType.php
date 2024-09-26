<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Event;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'html5' => true,  // Utilise le sélecteur HTML5 natif des navigateurs
                'attr' => ['class' => 'js-datepicker'],  // Optionnel: Classe pour customisation JS si nécessaire
            ]);
            if ($options['is_editing']) {
                // When editing, make the club field read-only and set its value
                $builder->add('club', EntityType::class, [
                    'class' => Club::class,
                    'choices' => $options['clubs'],
                    'choice_label' => 'name',
                    'disabled' => true, // Make the field read-only
                ]);
            } else {
                // When creating, allow selection of club
                $builder->add('club', EntityType::class, [
                    'class' => Club::class,
                    'choices' => $options['clubs'],
                    'choice_label' => 'name',
                ]);
            }
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'clubs' => [],  // Define 'clubs' option with a default empty array
            'is_editing' => false, // Default value for is_editing
        ]);

        // Allow is_editing option
        $resolver->setAllowedTypes('is_editing', 'bool');
    
    }
}
