<?php

namespace App\Repository;

use App\Entity\MoyenDeLevage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use PDO;

/**
 * @extends ServiceEntityRepository<MoyenDeLevage>
 *
 * @method MoyenDeLevage|null find($id, $lockMode = null, $lockVersion = null)
 * @method MoyenDeLevage|null findOneBy(array $criteria, array $orderBy = null)
 * @method MoyenDeLevage[]    findAll()
 * @method MoyenDeLevage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoyenDeLevageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MoyenDeLevage::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MoyenDeLevage $entity, bool $flush = true): void
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

     public function remove(MoyenDeLevage $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


     /******************************** LISTE RECHERCHE LEVAGE ******************************************/
 
            public function selection_moyen($numero_serie): array
            {
                  
                    $conn = $this->getEntityManager()->getConnection();
                    $sql = "SELECT * FROM moyen_de_levage WHERE numero LIKE CONCAT('%', :numero_serie, '%')";        
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':numero_serie', $numero_serie, PDO::PARAM_STR);
                    $resultSet = $stmt->executeQuery();
                    // returns an array of arrays (i.e. a raw data set)
                    return $resultSet->fetchAllAssociative();
            }

        
            /******************************** LISTE RECHERCHE SUR UN NUMERO DE SERIE ******************************************/

            public function selection_moyen_unique($numero): array
            {
                  
                    $conn = $this->getEntityManager()->getConnection();
                    $sql = "SELECT * FROM moyen_de_levage WHERE numero=:numero_serie";        
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':numero_serie', $numero, PDO::PARAM_STR);
                    $resultSet = $stmt->executeQuery();
                    // returns an array of arrays (i.e. a raw data set)
                    return $resultSet->fetchAllAssociative();
            }


                        /******************************** LISTE RECHERCHE VALIDER UN MOYEN QUALITE******************************************/

                        public function recherche_valider_moyen_qualite(): array
                        {
                              
                                $conn = $this->getEntityManager()->getConnection();
                                $sql = "SELECT * FROM `moyen_de_levage` WHERE statusmoyen='Demande passage statut prod' AND approbationqualite=0 ";        
                                $stmt = $conn->prepare($sql);
                                $resultSet = $stmt->executeQuery();
                                // returns an array of arrays (i.e. a raw data set)
                                return $resultSet->fetchAllAssociative();
                        }


                        /******************************** LISTE RECHERCHE VALIDER UN MOYEN ******************************************/

                         public function recherche_valider_moyen_maintenance(): array
                              {
                                                     
                                   $conn = $this->getEntityManager()->getConnection();
                                   $sql = " SELECT * FROM `moyen_de_levage` WHERE statusmoyen='Demande passage statut prod' AND approbationmaintenance=0 ";        
                                   $stmt = $conn->prepare($sql);
                                   $resultSet = $stmt->executeQuery();
                                  // returns an array of arrays (i.e. a raw data set)
                                    return $resultSet->fetchAllAssociative();
                               }


    /************************INSERER UNE VOITURE******************************************/
    /*
    public function insertion($nomdevoiture, $prix, $anneecirculation, $kilometrage, $contact, $nouveauNom1, $nouveauNom2, $nouveauNom3, $nouveauNom4, $moteur, $transmission, $carrosserie): array
    {
            $conn = $this->getEntityManager()->getConnection();
            $sql = "INSERT INTO voitures (nom, prix, anneecirculation, kilometrage, contact, image1, image2, image3, image4, moteur, transmission, carrosserie) VALUES ('$nomdevoiture', '$prix', '$anneecirculation','$kilometrage', '$contact','$nouveauNom1', '$nouveauNom2','$nouveauNom3','$nouveauNom4','$moteur','$transmission','$carrosserie')";  
            $stmt = $conn->prepare($sql);
            $resultSet = $stmt->executeQuery();
            // returns an array of arrays (i.e. a raw data set)
            return $resultSet->fetchAllAssociative();
    }
    */

    /****************************INSERER UN MOYEN DE LEVAGE *****************************************/
    public function insertion($user_name,$numero, $description_form, $cmu, $zone_service_form, $fournisseurs_form, $emplacement_form, $statusmoyen_form, $dateverifbv, $statusbv_form, $motifBV_form, $observations, $pilote_form, $delais, $actions, $commentaire,$nouveauNom2, $nouveauNom3, $nouveauNom1, $nouveauNom5, $nouveauNom6, $nouveauNom7,$approbationqualite, $appobationmaintenance, $dateenregistrement, $date_mise_ajour, $statut_final, $nouveauNom4): array
    {
            $conn = $this->getEntityManager()->getConnection();
            $sql = "INSERT INTO moyen_de_levage (user_name, 
                                                    numero, 
                                                    description, 
                                                    cmu,  
                                                    zoneservice,  
                                                    fournisseur, 
                                                    emplacement,  
                                                    statusmoyen,  
                                                    dateverifbv,  
                                                    statut_bv,  
                                                    motifbv,  
                                                    observation,  
                                                    pilotecloture,  
                                                    delais,  
                                                    actionscloture,  
                                                    commentaires,  
                                                    certificatce,  
                                                    ficheadequation,  
                                                    rapport,  
                                                    plan,  
                                                    notedecalcul,  
                                                    imagemoyen,  
                                                    approbationqualite,  
                                                    approbationmaintenance,  
                                                    dateenregistrement,  
                                                    date_mise_ajour, 
                                                    statut_final,
                                                    mise_en_service) 
                                                                   VALUES (
                                                                           '$user_name', 
                                                                           '$numero', 
                                                                           '$description_form',
                                                                           '$cmu', 
                                                                           '$zone_service_form',
                                                                           '$fournisseurs_form', 
                                                                           '$emplacement_form',
                                                                           '$statusmoyen_form',
                                                                           '$dateverifbv',
                                                                           '$statusbv_form',
                                                                           '$motifBV_form',
                                                                           '$observations',
                                                                           '$pilote_form',
                                                                           '$delais',
                                                                           '$actions',
                                                                           '$commentaire',
                                                                           '$nouveauNom2',
                                                                           '$nouveauNom3',
                                                                           '$nouveauNom1',
                                                                           '$nouveauNom5',
                                                                           '$nouveauNom6',
                                                                           '$nouveauNom7',
                                                                           '$approbationqualite',
                                                                           '$appobationmaintenance',
                                                                           '$dateenregistrement',
                                                                           '$date_mise_ajour',
                                                                           '$statut_final',
                                                                           '$nouveauNom4'
                                                                           )";  
            $stmt = $conn->prepare($sql);
            $resultSet = $stmt->executeQuery();
            // returns an array of arrays (i.e. a raw data set)
            return $resultSet->fetchAllAssociative();
    }


           /***********************SUPPRIMER UN MOYEN DE LEVAGE****************************************************/ 
           public function delete_moyen($numero): array
           {
               $conn = $this->getEntityManager()->getConnection();
               $sql = "DELETE FROM moyen_de_levage WHERE numero = :numero";        
               $stmt = $conn->prepare($sql);
               $stmt->bindValue(':numero', $numero, PDO::PARAM_STR);
               $resultSet = $stmt->executeQuery();
               // returns an array of arrays (i.e. a raw data set)
               return $resultSet->fetchAllAssociative();
           }

            /***********************VALIDER LE MOYEN QUALITE****************************************************/ 
            public function upgrade_qualite($numero): array
            {
                    $conn = $this->getEntityManager()->getConnection();
                    $sql = "UPDATE moyen_de_levage SET 
                    approbationqualite=1              
                    WHERE numero='$numero'";        
                    $stmt = $conn->prepare($sql);
                    $resultSet = $stmt->executeQuery();
                    // returns an array of arrays (i.e. a raw data set)
                    return $resultSet->fetchAllAssociative();
            }   
            
            
             /****************************MODIFIER MOYEN DE LEVAGE***************************************************/ 
                                public function modifier_moyen_de_levage($numero,
                                                                        $description_form,
                                                                        $cmu_form, 
                                                                        $zone_service_form, 
                                                                        $fournisseurs_form, 
                                                                        $emplacement_form, 
                                                                        $statusmoyen_form, 
                                                                        $dateverifbv, 
                                                                        $statusbv_form, 
                                                                        $motifBV_form, 
                                                                        $observations,
                                                                        $pilote_form, 
                                                                        $delais_form,
                                                                        $actions_form,
                                                                        $commentaire_form,
                                                                        $date_mise_ajour,
                                                                        $nouveauNom1,
                                                                        $nouveauNom2,
                                                                        $nouveauNom3,
                                                                        $nouveauNom4,
                                                                        $nouveauNom5,
                                                                        $nouveauNom6,
                                                                        $nouveauNom7
                                                                        ): array
                        {
                       //    var_dump($numero);
                                $conn = $this->getEntityManager()->getConnection();
                                $sql = "UPDATE moyen_de_levage SET 
                                description='$description_form',
                                cmu='$cmu_form',
                                zoneservice='$zone_service_form',
                                fournisseur='$fournisseurs_form',
                                emplacement='$emplacement_form',
                                statusmoyen='$statusmoyen_form',
                                dateverifbv='$dateverifbv',
                                statut_bv='$statusbv_form',
                                motifbv='$motifBV_form',
                                observation='$observations',
                                pilotecloture='$pilote_form',
                                delais='$delais_form',
                                actionscloture='$actions_form',
                                commentaires='$commentaire_form',
                                certificatce='$nouveauNom2',
                                ficheadequation='$nouveauNom3',
                                rapport='$nouveauNom1',
                                plan='$nouveauNom5',
                                notedecalcul='$nouveauNom6',
                                imagemoyen='$nouveauNom7',
                                mise_en_service='$nouveauNom4',
                                date_mise_ajour='$date_mise_ajour'                              
                                WHERE numero='$numero'";        
                                $stmt = $conn->prepare($sql);
                                $resultSet = $stmt->executeQuery();
                                // returns an array of arrays (i.e. a raw data set)
                                return $resultSet->fetchAllAssociative();
                        }    

            
            

                        /***********************VMISE A JOUR NOT ADMIN EN PRODUCTION****************************************************/ 

                        public function mise_a_jour_admin_prod($numero, $zone_service_form,  $emplacement_form,  $pilote_form,  $delais_form, $actions_form, $commentaire_form): array
                        {
                              
                                $date_aujourdhui=date('Y-m-d'); 

                                $conn = $this->getEntityManager()->getConnection();
                                $sql = "UPDATE moyen_de_levage SET 
                                zoneservice=:zone_service_form,
                                emplacement=:emplacement_form,
                                pilotecloture=:pilote_form,
                                delais=:delais_form,
                                actionscloture=:actions_form,
                                commentaires=:commentaire_form,
                                date_mise_ajour=:date_aujourdhui                                                                           
                                WHERE numero=:numero";        
                                $stmt = $conn->prepare($sql);
                                $stmt->bindValue(':zone_service_form', $zone_service_form, PDO::PARAM_STR);
                                $stmt->bindValue(':emplacement_form', $emplacement_form, PDO::PARAM_STR);
                                $stmt->bindValue(':pilote_form', $pilote_form, PDO::PARAM_STR);
                                $stmt->bindValue(':delais_form', $delais_form, PDO::PARAM_STR);
                                $stmt->bindValue(':actions_form', $actions_form, PDO::PARAM_STR);
                                $stmt->bindValue(':commentaire_form',$commentaire_form, PDO::PARAM_STR);
                                $stmt->bindValue(':numero', $numero, PDO::PARAM_STR);
                                $stmt->bindValue(':date_aujourdhui', $date_aujourdhui, PDO::PARAM_STR);
                              
                                $resultSet = $stmt->executeQuery();
                                // returns an array of arrays (i.e. a raw data set)
                                return $resultSet->fetchAllAssociative();
                        }   


              /***********************VALIDER LE MOYEN MAINTENANCE***********************************************/ 
              public function upgrade_maintenance($numero): array
              {
                    $conn = $this->getEntityManager()->getConnection();
                    $sql = "UPDATE moyen_de_levage SET 
                    approbationmaintenance=1              
                    WHERE numero='$numero'";        
                    $stmt = $conn->prepare($sql);
                    $resultSet = $stmt->executeQuery();
                    // returns an array of arrays (i.e. a raw data set)
                    return $resultSet->fetchAllAssociative();
              }


                  /***********************MISE A JOUR DU STATUS FINAL***********************************************/ 
                    public function update_statut_final($numero): array
                       {
                             $conn = $this->getEntityManager()->getConnection();
                             $sql = "UPDATE moyen_de_levage SET 
                             statut_final='approuvé',
                             statusmoyen='En production'              
                             WHERE numero='$numero'";        
                             $stmt = $conn->prepare($sql);
                             $resultSet = $stmt->executeQuery();
                             // returns an array of arrays (i.e. a raw data set)
                             return $resultSet->fetchAllAssociative();
                        }

    // /**
    //  * @return MoyenDeLevage[] Returns an array of MoyenDeLevage objects
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
    public function findOneBySomeField($value): ?MoyenDeLevage
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
