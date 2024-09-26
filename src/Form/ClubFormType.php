<?php

namespace App\Form;

use App\Entity\Club;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class ClubFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('socialLink')
            ->add('description')
            ->add('clubImg', FileType::class, [
                'label' => 'Logo Club :',
                'required' => false,
                'mapped' => false, // If it's not directly mapped to the database field
            ])
            ->add('genererImg', CheckboxType::class, [
                'label' => 'Generer une image de profil',
                'required' => false,
                'mapped' => false, // Not related to the entity
            ]);
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Club::class,
        ]);
    }
}
