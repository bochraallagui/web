<?php
namespace App\Repository;

use App\Entity\User;
use App\Model\SearchUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function countU()
    {
        return $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->where('u.role LIKE :role')
            ->setParameter('role', 'Utilisateur')
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function countL()
    {
        return $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->where('u.role LIKE :role')
            ->setParameter('role', 'livreur')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // public function findByNom($nom)
    // {
    //     return $this->createQueryBuilder('user')
    //         ->where('user.nom LIKE  :nom')
    //         ->setParameter('nom', '%'.$nom. '%')
    //         ->getQuery()
    //         ->getResult();
    // }

    public function orderByNom()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.nom', 'ASC')
            ->getQuery()->getResult();
    }

}
