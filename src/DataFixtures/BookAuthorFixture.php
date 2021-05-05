<?php

namespace App\DataFixtures;
use App\Entity\BookAuthor;
use App\Entity\Book;
use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BookAuthorFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager){

        $repoAuthor = $manager->getRepository(Author::class);
        $authors = $repoAuthor->findOneBy(['id' => rand(0,25)]);

        $repoBook = $manager->getRepository(Book::class);
        $books = $repoBook->findOneBy(['id' => rand(0,25)]);

        for ($i = 0; $i < 25 ; $i++){
            $bookAuthor = new BookAuthor([
                'idAuthor' => $authors,
                'idBook'=> $books,
                //tous les mêmes mais ok pr le moment
            ]);
            $manager->persist($bookAuthor);
            }
        $manager->flush(); 
    }

    public function getDependencies()
    {
        return [
            AuthorFixture::class,
            BookFixture::class,
        ];
    }
}
