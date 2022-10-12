<?php

namespace App\Repository;

use App\Entity\LanguageExempleType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LanguageExempleType>
 *
 * @method LanguageExempleType|null find($id, $lockMode = null, $lockVersion = null)
 * @method LanguageExempleType|null findOneBy(array $criteria, array $orderBy = null)
 * @method LanguageExempleType[]    findAll()
 * @method LanguageExempleType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LanguageExempleTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LanguageExempleType::class);
    }

    public function save(LanguageExempleType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LanguageExempleType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LanguageExempleType[] Returns an array of LanguageExempleType objects
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

//    public function findOneBySomeField($value): ?LanguageExempleType
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
