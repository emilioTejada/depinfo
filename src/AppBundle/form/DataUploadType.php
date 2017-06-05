<?php

namespace AppBundle\form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class DataUploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'data',
                'file',
                [
                    'label' => 'Importar archivo de usuarios',
                    'attr' => [
                        "accept" => ".xls",
                    ],
                    'constraints' => [
                        new NotBlank(),
                        new File([
                            "mimeTypes" => ['application/vnd.ms-excel', 'application/vnd.ms-office'],
                            "mimeTypesMessage" => "formato erroneo",
                        ])
                    ]
                ]
            )
            ->setMethod($options['method']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\UploadedFileUsers',
                'method' => 'post',
                'csrf_protection' => false,
                'constraints' => [
                ],
            ]
        );
    }
}