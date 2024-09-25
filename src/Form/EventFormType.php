<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Event;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('date', DateTime::class, [
                'widget' => 'single_text',
                'html5' => true,  // Utilise le sélecteur HTML5 natif des navigateurs
                'attr' => ['class' => 'js-datepicker'],  // Optionnel: Classe pour customisation JS si nécessaire
            ])
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
