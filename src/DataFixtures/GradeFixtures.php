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

use App\Entity\Grade;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

final class GradeFixtures extends Fixture
{
    /**
     * Loading function
     *
     * @param ObjectManager $manager Getting Doctrine
     */
    public function load(ObjectManager $manager): void
    {
        $grade = new Grade();
        $grade->setName('Ourson');

        $manager->persist($grade);
        $manager->flush();

        $this->addReference('grade', $grade);
    }
}
