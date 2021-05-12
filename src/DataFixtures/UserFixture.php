<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use Faker;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 3 ; $i++){
            $user = new User();
            $user->setLogin ("utilisateur".$i);
            $user->setPassword($this->passwordEncoder->encodePassword(
                 $user,
                 'mdp'.$i
             ));
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setEmail("monmail".$i."@test.com");
            $user->setIsAdmin(false);
            $user->setBirthdate($faker->dateTime);
            $manager->persist ($user);
        }
        $manager->flush();
    }
}
