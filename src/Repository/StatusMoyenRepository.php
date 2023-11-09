<?php

namespace App\Repository;

use App\Entity\StatusMoyen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusMoyen>
 *
 * @method StatusMoyen|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusMoyen|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusMoyen[]    findAll()
 * @method StatusMoyen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusMoyenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusMoyen::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(StatusMoyen $entity, bool $flush = true): void
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
    public function remove(StatusMoyen $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


          /******************************** LISTE DEROULANTE SPECIFIQUE A LA BDD (STATUS DU MOYEN) ******************************************/
 
          public function statusmoyen(): array
          {
                  $conn = $this->getEntityManager()->getConnection();
                  $sql = "SELECT DISTINCT(statusmoyen) FROM moyen_de_levage";        
                  $stmt = $conn->prepare($sql);
                  $resultSet = $stmt->executeQuery();
                  // returns an array of arrays (i.e. a raw data set)
                  return $resultSet->fetchAllAssociative();
          }

    // /**
    //  * @return StatusMoyen[] Returns an array of StatusMoyen objects
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
    public function findOneBySomeField($value): ?StatusMoyen
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
