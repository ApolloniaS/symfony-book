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
        $authors = $repoAuthor->findAll();

        $repoBook = $manager->getRepository(Book::class);
        $books = $repoBook->findAll();

        for ($i = 0; $i < 25 ; $i++){
            $bookAuthor = new BookAuthor([
                'idAuthor' => $authors[array_rand($authors)],
                'idBook'=> $books[$i],
                
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
