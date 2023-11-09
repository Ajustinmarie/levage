<?php

namespace App\Repository;

use App\Entity\MotifBV;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MotifBV>
 *
 * @method MotifBV|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotifBV|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotifBV[]    findAll()
 * @method MotifBV[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotifBVRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MotifBV::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MotifBV $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(MotifBV $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

         /******************************** LISTE DEROULANTE SPECIFIQUE A LA BDD (MOTIF BV) ******************************************/
 
         public function motifBV(): array
         {
                 $conn = $this->getEntityManager()->getConnection();
                 $sql = "SELECT DISTINCT(motifbv) FROM moyen_de_levage";        
                 $stmt = $conn->prepare($sql);
                 $resultSet = $stmt->executeQuery();
                 // returns an array of arrays (i.e. a raw data set)
                 return $resultSet->fetchAllAssociative();
         }

    // /**
    //  * @return MotifBV[] Returns an array of MotifBV objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MotifBV
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
