<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Form;

use App\Entity\Category;
use App\Entity\Figure;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FigureFormType.
 */
class FigureFormType extends AbstractType
{
    /**
     * Build a Figure form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add(
                'category',
                EntityType::class,
                [
                    'class' => Category::class,
                    'choice_label' => 'name',
                ]
            )
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImageFormType::class,
                    'allow_add' => true,
                    'by_reference' => false,
                ]
            )
            ->add(
                'videos',
                CollectionType::class,
                [
                    'entry_type' => VideoFormType::class,
                    'allow_add' => true,
                    'by_reference' => false,
                ]
            )
        ;
    }

    /**
     * Set entities classes link to this form type and some options
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Figure::class,
                'validation_class' => ['Default', 'new'],
            ]
        );
    }
}
