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

use App\Entity\Avatar;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

final class AvatarFixtures extends Fixture
{
    /**
     * Loading function
     *
     * @param ObjectManager $manager Getting Doctrine
     */
    public function load(ObjectManager $manager): void
    {
        $avatar = new Avatar();
        $avatar->setName('Ours polaire');
        $avatar->setFileName('assets/images/Ours_polaire_evolution.png');

        $manager->persist($avatar);
        $manager->flush();

        $avatar = new Avatar();
        $avatar->setName('Ourson');
        $avatar->setFileName('assets/images/Ourson_evolution.png');

        $manager->persist($avatar);
        $manager->flush();

        $this->addReference('avatar', $avatar);
    }
}
