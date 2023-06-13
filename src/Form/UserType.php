<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name', TextType::class, [
                'label' => 'Ad'
            ])
            ->add('surname', TextType::class, [
                'label' => 'Soyad'
            ])
            ->add('email', TextType::class, [
                'label' => 'Email'
            ])
            ->add('password')
            ->add('gender', ChoiceType::class, [
                'label' => 'Cinsiyet',
                'choices'  => [
                    'Belirtmek İstemiyorum.' => 1,
                    'Kadın' => 2,
                    'Erkek' => 3,
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Profil Fotoğrafı',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*'
                        ],
                        'mimeTypesMessage' => 'Lütfen Profil Fotoğrafı Yükleyin.',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
