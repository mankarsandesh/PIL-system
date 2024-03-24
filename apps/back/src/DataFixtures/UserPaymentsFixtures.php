<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\UserPayment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserPaymentsFixtures extends Fixture
{
    // public function __construct(
    //     private readonly UserPasswordHasherInterface $passwordHasher,
    // ) {
    // }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User('super-admin', 'admin');
        // create 20 user transactions! Bam!
        for ($i = 0; $i < 20; $i++) {
            $data = new UserPayment();
            $data->setCode('CD 423' . $i);
            $data->setGpsLocation("48.87305649334, 2.363220486813261");
            $data->setAmount(mt_rand(10, 1000));
            $data->setCurrency('USD');
            $data->setStatus('SUCCESS');
            $data->setUser($this->getReference('super-admin', User::class));
            $data->setDateTime(new \DateTime());
            $manager->persist($data);
        }



        $manager->flush();
    }
}
