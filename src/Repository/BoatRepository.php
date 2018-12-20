<?php

/**
 * Boat Repository File
 *
 * PHP Version 7.2
 *
 * @category Boat
 * @package  App\Repository
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace App\Repository;

use App\Entity\Boat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Boat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Boat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Boat[]    findAll()
 * @method Boat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoatRepository extends ServiceEntityRepository
{
    /**
     * BoatRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Boat::class);
    }
}
