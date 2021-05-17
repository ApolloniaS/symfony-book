<?php

namespace App\DataFixtures;

use App\Entity\Audience;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AudienceFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $audience = ['Tout public', 'Adolescent', 'Adulte'];
        $idAudience = count($audience);

                for ($i = 0; $i < 25 ; $i++){
                    $targetAudience = new Audience([
                        'audienceGroup' => $audience[rand(0, ($idAudience - 1))],
                    ]);
                    $manager->persist($targetAudience);
                    }

        $manager->flush();
    }
}
