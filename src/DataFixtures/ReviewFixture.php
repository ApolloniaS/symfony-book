<?php

namespace App\DataFixtures;

use App\Entity\Review;
use App\Entity\User;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ReviewFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $repUser = $manager->getRepository(User::class);
        $users = $repUser->findOneBy(['id' => rand(0,3)]);

        $repoBook = $manager->getRepository(Book::class);
        $books = $repoBook->findOneBy(['id' => rand(0,25)]);

        $faker = Faker\Factory::create();
        for ($i = 0; $i < 25 ; $i++){
            $book = new Review([
                'idUser' => $users,
                'idBook'=> $books,
                'reviewContent' => $faker->realText(200),
                'reviewScore'=>rand(0,5),
                'reviewDate'=>$faker->dateTime, 
            ]);
            $manager->persist($book);
            }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixture::class,
            BookFixture::class,
        ];
    }
}
