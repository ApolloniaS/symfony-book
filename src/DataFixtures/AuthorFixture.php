<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AuthorFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 25 ; $i++){
            $author = new Author([
                'lastName' => $faker->lastName,
                'firstName'=>$faker->firstName,
            ]);
            $manager->persist($author);
            }
        $manager->flush();
    }

}