<?php

namespace App\Repository;

use App\Entity\Favlist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Favlist>
 *
 * @method Favlist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favlist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favlist[]    findAll()
 * @method Favlist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavlistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favlist::class);
    }

    public function getUserFavlists()
    {
        return $this->createQueryBuilder('user')
            ->leftJoin('user.favlists', 'favlist')
            ->addSelect('favlist.products')
            ->getQuery()
            ->getResult();
    }
}
