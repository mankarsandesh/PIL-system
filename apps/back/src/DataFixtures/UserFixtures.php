<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }



    public function load(ObjectManager $manager): void
    {
        $user = new User('super-admin', 'admin@tcm.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_ADMIN']);

        $user1 = new User('user1', 'user1@tcm.com');
        $user1->setPassword($this->passwordHasher->hashPassword($user1, 'admin'));
        $user1->setRoles(['ROLE_USER']);

        $manager->persist($user);
        $manager->persist($user1);
        $manager->flush();

        // store reference to user transation for User relation to userPayments
        $this->addReference('super-admin', $user);
        $this->addReference('user1', $user1);
    }
}
