<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ReviewFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 25 ; $i++){
            $book = new Review([
                'reviewContent' => $faker->realText(200),
                'reviewScore'=>rand(0,5),
                'reviewDate'=>$faker->dateTime, 
            ]);
            $manager->persist($book);
            }
        $manager->flush();
    }
}
