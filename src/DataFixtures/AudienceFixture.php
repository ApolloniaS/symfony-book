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
        

                for ($i = 0; $i < count($audience) ; $i++){
                    $targetAudience = new Audience([
                        'audienceGroup' => $audience[$i],
                    ]);
                    $manager->persist($targetAudience);
                    }

        $manager->flush();
    }
}
