<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Url;

/**
 * Class VideoFormType.
 */
class VideoFormType extends AbstractType
{
    /**
     * Build a video form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'url',
            UrlType::class,
            [
                'help' => 'Format: https://www.youtube.com/embed/(your video id)',
                'constraints' =>
                [
                    new NotBlank(),
                    new Url(['message' => 'This url is not valid.']),
                    /**new Regex(
                        [
                            'pattern' => '(https?|http):\/\/[a-z0-9\/.]+\/embed\/[a-zA-Z0-9]+',
                            'message' => 'Please enter a valid url.',
                        ]
                    ),*/
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
                'data_class' => Video::class,
                'validation_class' => ['Default'],
            ]
        );
    }
}
