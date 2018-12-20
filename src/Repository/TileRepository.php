<?php

/**
 * Tile Repository File
 *
 * PHP Version 7.2
 *
 * @category Tile
 * @package  App\Repository
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace App\Repository;

use App\Entity\Tile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tile[]    findAll()
 * @method Tile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TileRepository extends ServiceEntityRepository
{
    /**
     * TileRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tile::class);
    }

    /**
     * Set false to hasTreasure to all tiles
     */
    public function removeAllTreasures(): void
    {
        $this->createQueryBuilder('t')
            ->update()
            ->set('t.hasTreasure', ':false')
            ->setParameter('false', false)
            ->getQuery()
            ->execute();
    }
}
