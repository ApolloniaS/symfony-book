<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class BookFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 25 ; $i++){
            $book = new Book([
                'title' => $faker->realText(25),
                'summary'=>$faker->realText(200),
                'firstRelease'=>$faker->dateTime, 
            ]);
            $manager->persist($book);
            }
        $manager->flush();
    }
}