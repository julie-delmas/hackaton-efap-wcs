<?php

/**
 * Main DataFixtures File
 *
 * PHP Version 7.2
 *
 * @category DataFixtures
 * @package  App\DataFixtures
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace App\DataFixtures;

use App\Entity\Boat;
use App\Entity\Tile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 *
 * @category DataFixtures
 * @package  App\DataFixtures
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
final class AppFixtures extends Fixture
{
    /**
     * Loading function
     *
     * @param ObjectManager $manager Getting Doctrine
     */
    public function load(ObjectManager $manager): void
    {
        $tiles = [
            ['sea', 'sea', 'sea', 'sea', 'sea', 'island', 'sea', 'sea', 'sea', 'port', 'sea', 'sea'],
            ['sea', 'port', 'sea', 'island', 'sea', 'sea', 'sea', 'sea', 'sea', 'sea', 'island', 'sea'],
            ['sea', 'sea', 'sea', 'sea', 'sea', 'sea', 'sea', 'sea', 'island', 'sea', 'sea', 'sea'],
            ['sea', 'island', 'sea', 'sea', 'island', 'sea', 'sea', 'sea', 'sea', 'sea', 'sea', 'sea'],
            ['sea', 'sea', 'sea', 'sea', 'sea', 'sea', 'sea', 'island', 'sea', 'sea', 'port', 'sea'],
            ['island', 'sea', 'sea', 'sea', 'port', 'sea', 'sea', 'sea', 'sea', 'sea', 'sea', 'island'],
        ];

        foreach ($tiles as $y => $line) {
            foreach ($line as $x => $type) {
                $tile = new Tile();
                $tile->setType($type);
                $tile->setCoordX($x);
                $tile->setCoordY($y);
                $manager->persist($tile);
            }
        }

        $boat = new Boat();
        $boat->setCoordX(0);
        $boat->setCoordY(0);
        $boat->setName('Black Pearl');

        $manager->persist($boat);
        $manager->flush();
    }
}
