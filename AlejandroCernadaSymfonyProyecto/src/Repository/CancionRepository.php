<?php

namespace App\Repository;

use App\Entity\Cancion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cancion>
 */
class CancionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cancion::class);
    }

    //    /**
    //     * @return Cancion[] Returns an array of Cancion objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    public function findOneByTitulo($titulo): ?Cancion
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.titulo = :val')
            ->setParameter('val', $titulo)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function mostrarCancionesReproducciones()
    {
        return $this->createQueryBuilder('p')
            ->select('p.titulo, p.reproducciones')
            ->getQuery()
            ->getResult();
    }
}

    // public function findAll(): array{
    //     return $this->createQueryBuilder('e')
    //         ->getQuery()
    //         ->getResult();
    // }
