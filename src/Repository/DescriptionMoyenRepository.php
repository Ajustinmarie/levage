<?php

namespace App\Repository;

use App\Entity\DescriptionMoyen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DescriptionMoyen>
 *
 * @method DescriptionMoyen|null find($id, $lockMode = null, $lockVersion = null)
 * @method DescriptionMoyen|null findOneBy(array $criteria, array $orderBy = null)
 * @method DescriptionMoyen[]    findAll()
 * @method DescriptionMoyen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DescriptionMoyenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DescriptionMoyen::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(DescriptionMoyen $entity, bool $flush = true): void
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
    public function remove(DescriptionMoyen $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

            /******************************** LISTE DEROULANTE SPECIFIQUE A LA BDD (DESCRIPTION MOYEN DE LEVAGE) ******************************************/
 
            public function description_moyen_de_levage(): array
            {
                    $conn = $this->getEntityManager()->getConnection();
                    $sql = "SELECT DISTINCT(description) FROM moyen_de_levage";        
                    $stmt = $conn->prepare($sql);
                    $resultSet = $stmt->executeQuery();
                    // returns an array of arrays (i.e. a raw data set)
                    return $resultSet->fetchAllAssociative();
            }

    // /**
    //  * @return DescriptionMoyen[] Returns an array of DescriptionMoyen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DescriptionMoyen
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
