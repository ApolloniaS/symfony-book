<?php

namespace App\DataFixtures;
use App\Entity\BookCategory;
use App\Entity\Book;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BookCategoryFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager){

        $repCategory = $manager->getRepository(Category::class);
        $categories = $repCategory->findAll();

        $repoBook = $manager->getRepository(Book::class);
        $books = $repoBook->findAll();

        for ($i = 0; $i < 25 ; $i++){
            $bookCategory = new BookCategory([
                'idCategory' => $categories[array_rand($categories)],
                'idBook'=> $books[$i],
                //ne fnctionne pas, todo: check why
            ]);
            $manager->persist($bookCategory);
            }
        $manager->flush(); 
    }

    public function getDependencies()
    {
        return [
            CategoryFixture::class,
            BookFixture::class,
        ];
    }
}
