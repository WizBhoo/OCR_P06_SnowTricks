<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class CommentFormType.
 */
class CommentFormType extends AbstractType
{
    /**
     * Build a comment form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'content',
            TextType::class,
            [
                'constraints' =>
                [
                    new NotBlank(),
                    new Length(['min' => 10, 'max' => 255]),
                ],
            ]
        );
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
                'data_class' => Comment::class,
                'validation_class' => ['Default', 'new'],
                'csrf_protection' => true,
                'csrf_field_name' => '_token',
                'csrf_token_id'   => 'form_comment',
            ]
        );
    }
}
