<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Form;

use App\Entity\Snowboarder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RegistrationFormType.
 */
class RegistrationFormType extends AbstractType
{
    /**
     * build a form to register users
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, ['label' => 'Pseudo :'])
            ->add('firstName', TextType::class, ['label' => 'Prénom :'])
            ->add('lastName', TextType::class, ['label' => 'Nom :'])
            ->add('email', EmailType::class, ['label' => 'Email :'])
            ->add('password', PasswordType::class, ['label' => 'Password :'])
        ;
    }

    /**
     * set the default entity class link to this form type
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Snowboarder::class,
        ]);
    }
}
