<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // let's create some fake users
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $user = new User([
                'firstName' => $faker->firstName,
                'lastName' => $faker->lastName,
                'email' => $faker->lastName . '@' . $faker->freeEmailDomain,
                'login' => $faker->userName,
                'password' => $faker->password,
            ]);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
