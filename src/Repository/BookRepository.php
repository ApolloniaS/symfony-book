<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;



/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Book::class);
        $this->paginator = $paginator;
    }

    public function obtenirResultatsFiltres(SearchData $objFiltres)
    {
        
        $reqQB = $this->createQueryBuilder('book');
           


        
        // si le champ de recherche n'est pas vide. Ce champ sert à faire une recherche partialle
        if (!empty($objFiltres->keyword)) {
            $reqQB = $reqQB->andWhere('book.title LIKE :keyword')
                ->setParameter('keyword', '%' . $objFiltres->keyword . '%'); // le LIKE a besoin de % %
        }

        $reqQBQuery = $reqQB->getQuery();
        return $this->paginator->paginate(
            $reqQBQuery,
            $objFiltres->numeroPage, // objet $data dans le controller, propriété publique dans la classe
            25
        );
    }

    /* public function getOneBookRandomly($id)
    {
        $qb = $this->createQueryBuilder("b");
        $query = $qb->select('b')
            ->where('b.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
        $res = $query->getResult();

        return $res;
    } */
    //ok mais fonctionne pas avec le join donc aucun intérêt

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
