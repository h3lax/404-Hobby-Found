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
                'choice_label' => 'name',
                'placeholder' => 'Choose a club',

                // Utilisation d'un query_builder personnalisé
                'query_builder' => function (UserRepository $er) use ($user) {
                    // Requête personnalisée pour récupérer uniquement les clubs de l'utilisateur
                    return $er->createQueryBuilder('c')
                              ->where('c.user = :user')
                              ->setParameter('user', $user);
                }
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
