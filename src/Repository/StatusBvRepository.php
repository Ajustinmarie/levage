<?php

namespace App\Repository;

use App\Entity\StatusBv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusBv>
 *
 * @method StatusBv|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusBv|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusBv[]    findAll()
 * @method StatusBv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusBvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusBv::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(StatusBv $entity, bool $flush = true): void
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
    public function remove(StatusBv $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


     /******************************** LISTE DEROULANTE SPECIFIQUE A LA BDD (Status Bureau Veritas) ******************************************/
 
              public function statut_bv(): array
              {
                      $conn = $this->getEntityManager()->getConnection();
                      $sql = "SELECT DISTINCT(statut_bv) FROM moyen_de_levage";        
                      $stmt = $conn->prepare($sql);
                      $resultSet = $stmt->executeQuery();
                      // returns an array of arrays (i.e. a raw data set)
                      return $resultSet->fetchAllAssociative();
              }

    // /**
    //  * @return StatusBv[] Returns an array of StatusBv objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatusBv
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
