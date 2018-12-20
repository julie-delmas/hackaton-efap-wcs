<?php
/**
 * Created by PhpStorm.
 * User: tomy
 * Date: 14/12/18
 * Time: 10:54
 */

namespace App\Services;


use App\Entity\Tile;
use App\Repository\TileRepository;

class MapManager
{
    private $tileRepository;

    public function __construct(TileRepository $tileRepository)
    {
        $this->tileRepository =$tileRepository;
    }

    public function tileExists(int $x, int $y): bool
    {
        if(!$this->tileRepository->findOneBy(['coordX'=>$x, 'coordY'=>$y])){
            return false;
        }
        else{
            return true;
        }
    }

    public function getRandomIsland(): Tile
    {
        $island = $this->tileRepository->findBy(['type'=>'Island']);
        return $island[array_rand($island)];
    }
}
