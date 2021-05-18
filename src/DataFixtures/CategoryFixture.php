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

                for ($i = 0; $i < count($genres) ; $i++){
                    $category = new Category([
                        'categoryName' => $genres[$i],
                    ]);
                    $manager->persist($category);
                    }

        $manager->flush();
    }
}
