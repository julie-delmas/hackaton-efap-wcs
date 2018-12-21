<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\GlobalClock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * User Fixture class
 *
 * @category User
 * @package  App\DataFixtures
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
final class UserFixture extends Fixture implements DependentFixtureInterface
{
    /**
     * To encode password with injected service
     *
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * Global project's clock
     *
     * @var GlobalClock
     */
    private $clock;

    /**
     * UserFixture constructor.
     *
     * @param UserPasswordEncoderInterface $passwordEncoder Var to encode password
     * @param GlobalClock $clock Global project's clock
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, GlobalClock $clock)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->clock = $clock;
    }

    /**
     * Load ten users to DB
     *
     * @param ObjectManager $manager Doctrine Manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        // Loading ten users with different information by concat
        // Enter a DateTime now by TimeContinuum service
        $user = new User();
        $user
            ->setEmail('user@userfixtures.fixtures')
            ->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    'password'
                )
            )
            ->setFirstName('userFirstName')
            ->setAvatar($this->getReference('avatar'))
            ->setGrade($this->getReference('grade'))
            ->setCreationDate($this->clock->getNowInDateTime());

        $manager->persist($user);
    }

    public function getDependencies()
    {
        return array(
            AvatarFixtures::class,
            GradeFixtures::class,
        );
    }
}
