<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prixProduit', IntegerType::class, [
                'constraints' => [
                new GreaterThan([
                    'value' => 0,
                    'message' => 'Le prix doit être supérieur à zéro.'
                    ])]
                ])
                ->add('typePaiement', ChoiceType::class, array(
                    'choices'=> array(
                        'Espéce'=>'Espéce',
                        'Chéque'=>'Chéque',
                    )
                ))
                
            
            ->add('typeProduit', ChoiceType::class, array(
                'choices'=> array(
                    'Maison'=>'Maison',
                    'Informatique'=>'Informatique',
                    'Beauté'=>'Beauté',
                    'Electromenager'=>'Electromenager',
                    'Vêtement'=>'Vêtement',
                )
            ))



            ->add('descriptionProduit',TextareaType::class)
            ->add('image', FileType::class, [
                'data_class' => null,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG, PNG, GIF).',
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Confirmer ',
            ])
        
           ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }

    
}


