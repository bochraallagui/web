<?php

namespace App\Form;

use App\Entity\Reponse;
use App\Entity\User;
use App\Entity\Reclamation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('messageRep')
            ->add('etat')
            ->add('fkIdAdmin', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('fkIdReclamation', EntityType::class, [
                'class' => Reclamation::class,
                'choice_label' => 'id_rec',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reponse::class,
        ]);
    }
}
