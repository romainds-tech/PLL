<?php

namespace App\Repository;

use App\Entity\LanguageParadigme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LanguageParadigme>
 *
 * @method LanguageParadigme|null find($id, $lockMode = null, $lockVersion = null)
 * @method LanguageParadigme|null findOneBy(array $criteria, array $orderBy = null)
 * @method LanguageParadigme[]    findAll()
 * @method LanguageParadigme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LanguageParadigmeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LanguageParadigme::class);
    }

    public function save(LanguageParadigme $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LanguageParadigme $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LanguageParadigme[] Returns an array of LanguageParadigme objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LanguageParadigme
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
