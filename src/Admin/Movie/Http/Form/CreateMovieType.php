<?php

declare(strict_types=1);

namespace App\Admin\Movie\Http\Form;

use App\Admin\Movie\Domain\DTO\Request\CreateMovieRequest;
use App\Admin\Movie\Domain\DTO\Response\MovieResponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateMovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('apiId', HiddenType::class)
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Ex : Inception',
                    'autocomplete' => 'off',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Ex : Cette histoire des années 80 prends place dans...',
                ],
            ])
            ->add('poster', TextType::class, [
                'label' => 'Image',
                'attr' => [
                    'placeholder' => 'Image',
                ],
            ])
            ->add('genres', TextType::class, [
                'label' => 'Genres',
                'attr' => [
                    'placeholder' => 'Genres',
                ],
            ])
            ->add('directing', TextType::class, [
                'label' => 'Réalisation',
            ])
            ->add('releaseDate', TextType::class, [
                'label' => 'Date de sortie',
            ])
            ->add('voteAverage', HiddenType::class)
            ->add('voteCount', HiddenType::class)
//            ->add('date', TextType::class, [
//                'label' => 'Date de sortie',
//                'mapped' => false,
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateMovieRequest::class,
        ]);
    }
}
