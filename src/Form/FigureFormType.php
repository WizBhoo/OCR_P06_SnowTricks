<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Form;

use App\Entity\Figure;
use Symfony\Component\Form\AbstractType;
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
            ->add('slug')
            ->add('name')
            ->add('description')
            ->add('createdAt')
            ->add('updatedAt')
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
        $resolver->setDefaults([
            'data_class' => Figure::class,
            'validation_class' => ['Default'],
        ]);
    }
}
