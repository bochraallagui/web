<?php

namespace App\Form;

use App\Entity\Livraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;
use App\Entity\Pointderelais;
use App\Repository\UserRepository;


class LivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('dateLivraison', DateType::class, [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'view_timezone' => 'Europe/Paris', // add this line
        ])
            ->add('prixLivraison')
            ->add('adresseLivraison')
            ->add('etatLivraison')
            ->add('fkIdLivreur', EntityType::class, [
                'class' => User::class,
                'query_builder' => function (UserRepository $userRepository) {
                    return $userRepository->createQueryBuilder('u')
                        ->andWhere('u.role = :role')
                        ->setParameter('role', 'livreur')
                        ->orderBy('u.id', 'ASC');
                },
                'choice_label' => function (User $user) {
                    return sprintf('%d - %s %s', $user->getId(), $user->getNom(), $user->getPrenom());
                },
            ])
        
          ->add('fkIdPointderelais', EntityType::class, [
            'class' => Pointderelais::class,
            'choice_label' => 'idPointderelais',
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}