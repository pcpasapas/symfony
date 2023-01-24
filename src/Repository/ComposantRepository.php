<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Composant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Composant>
 *
 * @method Composant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Composant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Composant[]    findAll()
 * @method Composant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComposantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Composant::class);
    }

    public function save(Composant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Composant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneWithCategorie(int $id): ?Composant
    {
        return $this->createQueryBuilder('c')
            ->where('c.id = :val')
            ->setParameter('val', $id)
            ->leftJoin(Categorie::class, 'categorie', 'WITH', 'categorie.id = c.categorie')
            ->getQuery()
            ->getOneOrNullResult();

    }

//    /**
//     * @return Composant[] Returns an array of Composant objects
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

//    public function findOneBySomeField($value): ?Composant
//    {
//        return $this->createQueryBuilder('c')
//            ->where('c.id = $value')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
