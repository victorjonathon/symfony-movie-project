<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MovieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg rounded-0',
                    'placeholder' => 'Enter Movie Title'
                ],
                'label' => false
            ])
            ->add('releaseYear', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg mt-3 rounded-0',
                    'placeholder' => 'Enter Movie Year'
                ],
                'label' => false
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg mt-3 rounded-0',
                    'placeholder' => 'Enter Movie Description'
                ],
                'label' => false
            ])
            ->add('imagePath', FileType::class, [
                'attr' => [
                    'class' => 'form-control-lg mt-3 rounded-0'
                ],
                'label' => false,
                'required' => false,
                'mapped' => false
            ])
            //->add('actors')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
