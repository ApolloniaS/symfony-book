<?php

namespace App\DataFixtures;

use App\Entity\Audience;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BookFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $repAudience = $manager->getRepository(Audience::class);
        $audience = $repAudience->findAll();

        $faker = Faker\Factory::create();
        for ($i = 0; $i < 25 ; $i++){
            $book = new Book([
                
                'title' => $faker->realText(25),
                'summary'=>$faker->realText(200),
                'firstRelease'=>$faker->dateTime, 
                //'picture'=>$faker->imageUrl($width=200, $height=300),
                //fonctionne mais très lent et bcp de fail dans la requête au serveur
                'picture'=>rand(0,4).'.png',
                'idAudience' => $audience[array_rand($audience)],
            ]);
            $manager->persist($book);
            }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AudienceFixture::class,
        ];
    }

}