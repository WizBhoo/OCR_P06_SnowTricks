<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Form;

use App\Entity\Snowboarder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ForgottenPasswordFormType.
 */
class ForgottenPasswordFormType extends AbstractType
{
    /**
     * Build a forgotten password form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class)
        ;
    }

    /**
     * Set the default entity class link to this form type
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Snowboarder::class,
                'validation_class' => ['Default'],
            ]
        );
    }
}
