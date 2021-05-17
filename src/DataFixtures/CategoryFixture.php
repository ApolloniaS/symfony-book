<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Length;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $genres = ['poésie', 'historique', 'amour', 'nouvelle', 'histoire vraie', 'aventure',
                    'policier', 'thriller', 'science-fiction', 'heroic fantansy', 'horreur',
                    'biographie', 'théâtre', 'bd'];
        $idGenre = count($genres);

                for ($i = 0; $i < 25 ; $i++){
                    $category = new Category([
                        'categoryName' => $genres[rand(0, ($idGenre - 1))],
                    ]);
                    $manager->persist($category);
                    }

        $manager->flush();
    }
}
