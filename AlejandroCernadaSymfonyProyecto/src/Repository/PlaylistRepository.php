<?php

namespace App\Repository;

use App\Entity\Playlist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Playlist>
 */
class PlaylistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Playlist::class);
    }

    //    /**
    //     * @return Playlist[] Returns an array of Playlist objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Playlist
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function mostrarTodasSistema(){
        return $this->createQueryBuilder('p')
            ->where('p.propietario IS NULL') 
            ->getQuery()
            ->getResult();
    }

    public function mostrarPorUsuario($usuario){
        return $this->createQueryBuilder('p')
            ->andWhere('p.propietario = :val')
            ->setParameter('val', $usuario)
            ->getQuery()
            ->getResult();
    }


    public function mostrarPlaylistLikes(){
        return $this->createQueryBuilder('p')
            ->select('p.nombre, p.likes')
            ->getQuery()
            ->getResult();
    }

    public function mostrarPlaylistReproducciones(){
        return $this->createQueryBuilder('p')
            ->select('p.nombre, p.reproducciones')
            ->getQuery()
            ->getResult();
    }
}
