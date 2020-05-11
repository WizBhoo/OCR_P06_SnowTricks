<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ImageFormType.
 */
class ImageFormType extends AbstractType
{
    /**
     * Build an image form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('path', FileType::class)
            ->add(
                'primary',
                CheckboxType::class,
                [
                    'label' => 'Primary image ?',
                    'required' => false,
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
                'data_class' => Image::class,
                'validation_class' => ['Default'],
            ]
        );
    }
}
