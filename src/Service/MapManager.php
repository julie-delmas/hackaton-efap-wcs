<?php
/**
 * MapManager Service file
 *
 * PHP version 7.2
 *
 * @category Map
 * @package  App\Service
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace App\Service;

use App\Entity\Boat;
use App\Entity\Tile;
use App\Repository\TileRepository;

/**
 * MapManager Service class
 *
 * @category Map
 * @package  App\Service
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
final class MapManager
{
    /**
     * Tile repository
     *
     * @var TileRepository
     */
    private $tileRepository;

    /**
     * MapManager constructor.
     *
     * @param TileRepository $tileRepository
     */
    public function __construct(TileRepository $tileRepository)
    {
        $this->tileRepository = $tileRepository;
    }

    /**
     * Checking position on the map
     *
     * @param  int $x Given future X boat coordinate
     * @param  int $y Given future Y boat coordinate
     *
     * @return bool
     */
    public function tileExists(int $x, int $y): bool
    {
        if (!$this->tileRepository
            ->findOneBy(['coordX' => $x, 'coordY' => $y])) {
            return false;
        }
        return true;
    }

    /**
     * Get a random island
     *
     * @return Tile Returning Tile object
     */
    public function getRandomIsland(): Tile
    {
        $islands
            = $this->tileRepository->findBy(['type' => 'island']);
        return $islands[array_rand($islands)];
    }

    /**
     * Check if a treasure is on boat's coordinates
     *
     * @param  Boat $boat A Boat object
     * @return bool
     */
    public function checkTreasure(Boat $boat): bool
    {
        if ($tile = $this->tileRepository->findOneBy([
            'coordX' => $boat->getCoordX(),
            'coordY' => $boat->getCoordY()
        ])) {
            return $tile->getHasTreasure();
        }
        return false;
    }
}
