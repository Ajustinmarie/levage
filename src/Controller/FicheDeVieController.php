<?php

namespace App\Controller;

use App\Entity\DescriptionMoyen;
use App\Entity\Emplacement;
use App\Entity\Fournisseur;
use App\Entity\MotifBV;
use App\Entity\MoyenDeLevage;
use App\Entity\StatusBv;
use App\Entity\StatusMoyen;
use App\Entity\StatusMoyen2;
use App\Entity\User;
use App\Entity\ZoneService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheDeVieController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }


    /**
     * @Route("/fiche/de/vie", name="app_fiche_de_vie")
     */
    public function index(Request $request): Response
    {
        $numero_serie=null;
        $resultat_recherche=null;

        if ($request->isMethod('POST')) 
        {
               $recherche=$request->request->get('recherche');
               $numero_serie=$request->request->get('numero_serie');
        }

        $resultat_recherches=$this->entityManager->getRepository(MoyenDeLevage::class)->selection_moyen($numero_serie);
      // var_dump($resultat_recherche);
        
        return $this->render('fiche_de_vie/index.html.twig', [
            'numero_serie' => $numero_serie,
            'resultat_recherches'=>$resultat_recherches
        ]);
    }




     /**
     * @Route("/fiche/de/vie/modification/{numero}", name="fiche_de_vie_modification")
     */
    public function show($numero, Request $request): Response
    {     
       
       // $notification_validation=null;
       $notification_validation_maintenance=null;
        $notification_validation_qualite=null;
        $notification1=null;
        $notification2=null;
   

     /******************************************TOUTES LES LISTES DEROULANTES DU FORMULAIRE*************************************************************/     
          /* DESCRIPTION DU MOYEN */
          $description=$this->entityManager->getRepository(DescriptionMoyen::class)->findAll();
          /* ZONE /SERVICE */
          $zone_service=$this->entityManager->getRepository(ZoneService::class)->findAll();
           /* FOURNISSEURS */
          $fournisseurs=$this->entityManager->getRepository(Fournisseur::class)->findAll();

             /* EMPLACEMENT */
            $emplacements=$this->entityManager->getRepository(Emplacement::class)->findAll();

            /* STATUS DU MOYEN */
            $statusDuMoyen=$this->entityManager->getRepository(StatusMoyen::class)->findAll();

              /* STATUS DU MOYEN2 */
              $statusDuMoyen2=$this->entityManager->getRepository(StatusMoyen2::class)->findAll();
                /* STATUS BV */
                $statusBV=$this->entityManager->getRepository(StatusBv::class)->findAll();
                /* MOTIF BV */
                $motifBVs=$this->entityManager->getRepository(MotifBV::class)->findAll();
                /* PILOTE */
                $pilotes=$this->entityManager->getRepository(User::class)->findAll();
     /**************************************J'EXTRAIT LE NUMERO DE SERIE DE LA BDD*******************************************************************************************/
      
     $resultat_recherches_uniques=$this->entityManager->getRepository(MoyenDeLevage::class)->selection_moyen($numero);   

   //  var_dump($resultat_recherches_uniques);

      foreach ($resultat_recherches_uniques as $item) {        
        $description_bdd=$item['description'];
        $numero_bdd=$item['numero'];
        $cmu_bdd=$item['cmu'];
        $zoneservice_bdd=$item['zoneservice'];
        $fournisseurs_bdd=$item['fournisseur'];
        $commentaire_bdd=$item['commentaires'];

      

        $emplacements_bdd=$item['emplacement'];
        $statusDuMoyen_bdd=$item['statusmoyen'];
        $statusBV_bdd=$item['statut_bv'];
        $motifBVs_bdd=$item['motifbv'];
        $pilotes_bdd=$item['pilotecloture'];

        $delais_bdd=$item['delais'];
        $observations=$item['observation'];
        $actions_bdd=$item['actionscloture'];

        $action=$item['actionscloture'];
        $actions_bdd = html_entity_decode($action, ENT_QUOTES, 'UTF-8');

        $comment=$item['commentaires'];
        $commentaire = html_entity_decode($comment, ENT_QUOTES, 'UTF-8');


        $dateverifbv=$item['dateverifbv'];

        /*pieces jointes*/
        $certificate=$item['certificatce']; 
        $ficheadequation=$item['ficheadequation']; 
        $rapport=$item['rapport']; 
        $mise_en_service=$item['mise_en_service'];   
        $plan=$item['plan'];         
        $notedecalcul=$item['notedecalcul']; 
        $imagemoyen=$item['imagemoyen'];  


        $approbationmaintenance=$item['approbationmaintenance']; 
        $approbationqualite=$item['approbationqualite'];        
    }
        
    // var_dump($approbationmaintenance);
    // var_dump($approbationqualite);



    if ($request->isMethod('POST')) 
    {
                $valider_moyen=$request->request->get('validation_moyen');                    
                $mise_a_jour_fiche=$request->request->get('mise_a_jour_moyen'); 
                
                /*formulaire*/
                                             //   var_dump('succes');
                                             $description_form=htmlspecialchars($request->request->get('description'));
                                             $cmu_form=htmlspecialchars($request->request->get('cmu'));
                                             $zone_service_form=htmlspecialchars($request->request->get('zone_service'));
                                             $fournisseurs_form=htmlspecialchars($request->request->get('fournisseurs'));
                                             $emplacement_form=htmlspecialchars($request->request->get('emplacement'));       
                                             $statusmoyen_form=htmlspecialchars($request->request->get('statusmoyen'));
                                             $dateverifbv=htmlspecialchars($request->request->get('dateverifbv'));
                                             $statusbv_form=htmlspecialchars($request->request->get('statusbv'));
                                             $motifBV_form=htmlspecialchars($request->request->get('motifBV'));
                                             $observations=htmlspecialchars($request->request->get('observations'));
                                             $pilote_form=htmlspecialchars($request->request->get('pilote'));
                                             $delais_form=htmlspecialchars($request->request->get('delais'));
                                             $actions_form=htmlspecialchars($request->request->get('actions'));
                                             $commentaire_form=htmlspecialchars($request->request->get('commentaire'));
                                             // var_dump($commentaire);
                                                 /***************************PIECE JOINTES***************************/
                                             $rapportbv_form=$request->files->get('rapportbv');
                                             $certificate_form=$request->files->get('certificate');
                                             $adequation_form=$request->files->get('adequation');
                                             $mise_en_service_form=$request->files->get('mise_en_service');
                                             $plan_form=$request->files->get('plan');
                                             $note_de_calcul_form=$request->files->get('note_de_calcul');
                                             $img_moyen_form=$request->files->get('img_moyen');
                                             
                                             $date_mise_ajour= date('Y-m-d');

                                             $status_de_ladmin=htmlspecialchars($request->request->get('status_de_ladmin'));


                                            

                                           
                /*formulaire*/


                if($valider_moyen=='validation_moyen_maintenance')
                {
                    $this->entityManager->getRepository(MoyenDeLevage::class)->upgrade_maintenance($numero);   
                    $notification_validation_maintenance="Le moyen a bien été validé par le service maintenance";                   
                    $approbationmaintenance=1;
                    
                    if($approbationmaintenance==1 AND $approbationqualite==1)
                    {
                       $this->entityManager->getRepository(MoyenDeLevage::class)->update_statut_final($numero);
                    }
                        /***********************************FONCTION MAIL*********************************************/
                                  /*Variable du destinataire*/
                                                        /*mail indus*/
                                  $to ='kit.survieqhse18@gmail.com, ajustinmarie@gmail.com';
                                  /*le sujet du mail*/
                                  $subject = "Demande validation d'un moyen de levage";
                                  /*message*/
                                  /* pour afficher du php dans tes mail voici le secret la concatenation */
                                  $message=".<p>Le moyen de levage numero:$numero a été validé par le service maintenance<br/>
                                  <a href=\"wwww.\">lien</a><br/> </p>";
                              
                                  $header ="MIME Version 1.0\r\n";
                              /*mettre le lien du fichier style css */
                              $header .="Content-type: text/html; charset=UTF-8\r\n";
                              /*qui envoie le mail ? reply to=adresse pour celui qui recoit le mail pour qu'il puisse renvoyé au destinataire */                             
                              $header .="From: no-reply@qualite-it.com"."\r\n"."Reply-To: adressepoubelle@gmail.com"."\r\n"."X-mailer: PHP/".phpversion();

                              mail($to,$subject,$message, $header);  
                        /*********************************FONCTION MAIL***********************************************/
                }

                if($valider_moyen=='validation_moyen_qualite')
                {
                    $this->entityManager->getRepository(MoyenDeLevage::class)->upgrade_qualite($numero);    
                    $notification_validation_qualite="Le moyen a bien été validé par le service qualite";
                   
                    $approbationqualite=1;

                    if($approbationmaintenance==1 AND $approbationqualite==1)
                    {
                       $this->entityManager->getRepository(MoyenDeLevage::class)->update_statut_final($numero);
                    }

                         /***********************************FONCTION MAIL*********************************************/
                             /*Variable du destinataire*/
                                                      /*mail indus*/
                             $to ='kit.survieqhse18@gmail.com, ajustinmarie@gmail.com';
                             /*le sujet du mail*/
                             $subject = "Demande validation d'un moyen de levage";
                             /*message*/
                             /* pour afficher du php dans tes mail voici le secret la concatenation */
                             $message=".<p>Le moyen de levage numero:$numero a été validé par le service qualite<br/>
                             <a href=\"wwww.\">lien</a><br/> </p>";                             
                             $header ="MIME Version 1.0\r\n";
                         /*mettre le lien du fichier style css */
                         $header .="Content-type: text/html; charset=UTF-8\r\n";
                         /*qui envoie le mail ? reply to=adresse pour celui qui recoit le mail pour qu'il puisse renvoyé au destinataire */                             
                         $header .="From: no-reply@qualite-it.com"."\r\n"."Reply-To: adressepoubelle@gmail.com"."\r\n"."X-mailer: PHP/".phpversion();

                         mail($to,$subject,$message, $header); 
                      /***********************************FONCTION MAIL*********************************************/
                   //   return $this->redirectToRoute('fiche_de_vie_modification');
                      
                }


             /***********************************************OPTION DE MISE A JOUR ***********************************************************/
         

                if($mise_a_jour_fiche=='mise_a_jour_moyen')
                {
                   
                            
                            /******************NOT ADMIN EN PRODUCTION */
                            if(!empty($numero)) 
                            {
                                    if($statusDuMoyen_bdd == 'En production' AND $status_de_ladmin=='pas_admin') 
                                    {  
                                         //   $date_aujourdhui=date('Y-m-d'); 
                                         //  var_dump( $date_aujourdhui);
                                            
                                            if(empty($delais_form)) {
                                                $delais_form = '00-00-0000';
                                            }

                                            $this->entityManager->getRepository(MoyenDeLevage::class)->mise_a_jour_admin_prod($numero,
                                                                                                                                $zone_service_form,  
                                                                                                                                $emplacement_form,  
                                                                                                                                $pilote_form,  
                                                                                                                                $delais_form, 
                                                                                                                                $actions_form, 
                                                                                                                                $commentaire_form,
                                                                                                                               
                                                                                                                                );  
                                    
                                             $notification1='Le moyen de levage N°'.$numero.' à été mise à jour'; 
                                            // header("Refresh:2");
                                    }
                                    else
                                    {

                                                   
                                                                      
                                                                                                            $taille_autorise = 2000000000;
                                                                                                            /*****************************rapportbv*******************************/
                                                                                                            $taille1 = $rapportbv_form['size'];
                                                                                                            $nom_fichier1 = $rapportbv_form['name'];
                                                                                                            $dossierTempo1 = $rapportbv_form['tmp_name'];
                                                                                                            /*****************************certificate*****************************/
                                                                                                            $taille2 = $certificate_form['size'];
                                                                                                            $nom_fichier2 = $certificate_form['name'];
                                                                                                            $dossierTempo2 = $certificate_form['tmp_name'];
                                                                                                            /*** **************************adequation*****************************/
                                                                                                            $taille3 = $adequation_form['size'];
                                                                                                            $nom_fichier3 = $adequation_form['name'];
                                                                                                            $dossierTempo3 = $adequation_form['tmp_name'];
                                                                                                            /*****************************mise_en_service*****************************/
                                                                                                            $taille4 = $mise_en_service_form['size'];
                                                                                                            $nom_fichier4 = $mise_en_service_form['name'];
                                                                                                            $dossierTempo4 = $mise_en_service_form['tmp_name'];
                                                                                                            /*****************************plan*****************************/
                                                                                                            $taille5 = $plan_form['size'];
                                                                                                            $nom_fichier5 = $plan_form['name'];
                                                                                                            $dossierTempo5 = $plan_form['tmp_name'];
                                                                                                            /*****************************note_de_calcul*****************************/
                                                                                                            $taille6 = $note_de_calcul_form['size'];
                                                                                                            $nom_fichier6 = $note_de_calcul_form['name'];
                                                                                                            $dossierTempo6 = $note_de_calcul_form['tmp_name'];
                                                                                                            /*****************************img_moyen*****************************/
                                                                                                            $taille7 = $img_moyen_form['size'];
                                                                                                            $nom_fichier7 = $img_moyen_form['name'];
                                                                                                            $dossierTempo7 = $img_moyen_form['tmp_name'];

                                                                                                            /*****************************rapportbv*****************************/
                                                                                                            $extension1 = strchr($nom_fichier1, '.');
                                                                                                            /*****************************certificate*****************************/
                                                                                                            $extension2 = strchr($nom_fichier2, '.');
                                                                                                            /*****************************adequation*****************************/
                                                                                                            $extension3 = strchr($nom_fichier3, '.');
                                                                                                            /*****************************mise_en_service*****************************/
                                                                                                            $extension4 = strchr($nom_fichier4, '.');
                                                                                                            /*****************************plan*****************************/
                                                                                                            $extension5 = strchr($nom_fichier5, '.');
                                                                                                            /*****************************note_de_calcul*****************************/
                                                                                                            $extension6 = strchr($nom_fichier6, '.');
                                                                                                            /*****************************img_moyen*****************************/
                                                                                                            $extension7 = strchr($nom_fichier7, '.');

                                                                                                            $extension_autoriser = array('.png','.PNG','.jpg','.JPG','.pdf','');
                                                                                                           
                                                                                                           

                                                                                                            /*****************************rapportbv*****************************/
                                                                                                            $nouveauNom1 =   chr(rand(65, 90));
                                                                                                            $nouveauNom1 = '1-' . $nouveauNom1 . $extension1;
                                                                                                            $dossierReception1 = 'upload/' . $nouveauNom1;
                                                                                                            /*****************************certificate*****************************/
                                                                                                            $nouveauNom2 =  chr(rand(65, 122));
                                                                                                            $nouveauNom2 = '2-' . $nouveauNom2 . $extension2;
                                                                                                            $dossierReception2 = 'upload/' . $nouveauNom2;
                                                                                                            /*****************************adequation*****************************/
                                                                                                            $nouveauNom3 =  chr(rand(65, 90));
                                                                                                            $nouveauNom3 = '3-' . $nouveauNom3 . $extension3;
                                                                                                            $dossierReception3 = 'upload/' . $nouveauNom3;
                                                                                                            /*****************************mise_en_service*****************************/
                                                                                                            $nouveauNom4 =  chr(rand(65, 90));
                                                                                                            $nouveauNom4 = '4-' . $nouveauNom4 . $extension4;
                                                                                                            $dossierReception4 = 'upload/' . $nouveauNom4;
                                                                                                            /*****************************plan*****************************/
                                                                                                            $nouveauNom5 =  chr(rand(65, 90));
                                                                                                            $nouveauNom5 = '5-' . $nouveauNom5 . $extension5;
                                                                                                            $dossierReception5 = 'upload/' . $nouveauNom5;
                                                                                                            /*****************************note_de_calcul*****************************/
                                                                                                            $nouveauNom6 =  chr(rand(65, 90));
                                                                                                            $nouveauNom6 = '6-' . $nouveauNom6 . $extension6;
                                                                                                            $dossierReception6 = 'upload/' . $nouveauNom6;
                                                                                                            /*****************************img_moyen*****************************/
                                                                                                            $nouveauNom7 =  chr(rand(65, 90));
                                                                                                            $nouveauNom7 = '7-' . $nouveauNom7 . $extension7;
                                                                                                            $dossierReception7 = 'upload/' . $nouveauNom7;


                                                                                                            if(!in_array($extension1, $extension_autoriser) or !in_array($extension2, $extension_autoriser) or !in_array($extension3, $extension_autoriser) or !in_array($extension4, $extension_autoriser) or !in_array($extension5, $extension_autoriser) or !in_array($extension6, $extension_autoriser) or !in_array($extension7, $extension_autoriser)) {
                                                                                                                // echo'Extension Non autorisé!';
                                                                                                                $notification4 = 'Veuillez verifier les extensions de vos pièces jointes (png,jpg,pdf)';
                                                                                                            } elseif ($taille1 > $taille_autorise or $taille2 > $taille_autorise or $taille3 > $taille_autorise or $taille4 > $taille_autorise or $taille5 > $taille_autorise or $taille6 > $taille_autorise or $taille7 > $taille_autorise) {
                                                                                                                // echo 'Le fichier est trop volumineux!';
                                                                                                                $notification5 = 'Une de vos pièces jointes est trop volumineux';
                                                                                                            } else {

                                                                                                                if( $rapportbv_form['name'] == null or  $rapportbv_form['name']=='') {
                                                                                                                
                                                                                                                    $nouveauNom1 = $rapport;
                                                                                                                } else {
                                                                                                                    $testdeplacer1 = move_uploaded_file($dossierTempo1, $dossierReception1);
                                                                                                                    
                                                                                                                }

                                                                                                                if($certificate_form['name'] == null or $certificate_form['name']=='') {
                                                                                                                
                                                                                                                    $nouveauNom2 = $certificate;
                                                                                                                } else {
                                                                                                                    $testdeplacer2 = move_uploaded_file($dossierTempo2, $dossierReception2);
                                                                                                                }

                                                                                                                if($adequation_form['name'] == null or $adequation_form['name']=='') {
                                                                                                                    $nouveauNom3 = $ficheadequation;
                                                                                                                } else {
                                                                                                                
                                                                                                                    $testdeplacer3 = move_uploaded_file($dossierTempo3, $dossierReception3);
                                                                                                                }
                                                                                                            
                                                                                                            /*************************MISE EN SERVICE ***********************/
                                                                                                                if($mise_en_service_form['name'] == null or $mise_en_service_form['name']=='') {
                                                                                                                    $nouveauNom4 = $mise_en_service;
                                                                                                                } else {
                                                                                                                
                                                                                                                    $testdeplacer4 = move_uploaded_file($dossierTempo4, $dossierReception4);
                                                                                                                }
                                                                                                            /*************************MISE EN SERVICE ***********************/

                                                                                                            /*************************PLAN ***********************/
                                                                                                            //  var_dump($plan_form);
                                                                                                                if($plan_form['name']==NULL or $plan_form['name']=='') {                    
                                                                                                                    $nouveauNom5 = $plan;
                                                                                                                } 
                                                                                                                else
                                                                                                                {            
                                                                                                                    $testdeplacer5 = move_uploaded_file($dossierTempo5, $dossierReception5);
                                                                                                                }
                                                                                                            
                                                                                                            /*************************PLAN ***********************/


                                                                                                        /*************************NOTE DE CACLCUL ***********************/
                                                                                                                if($note_de_calcul_form['name'] == null or $note_de_calcul_form['name']=='') {
                                                                                                                    $nouveauNom6 = $notedecalcul;
                                                                                                                } else {
                                                                                                                    
                                                                                                                    $testdeplacer6 = move_uploaded_file($dossierTempo6, $dossierReception6);
                                                                                                                }
                                                                                                        /*************************NOTE DE CACLCUL ***********************/


                                                                                                        /*************************IMAGE MOYEN ***********************/
                                                                                                                if($img_moyen_form['name'] == null or  $img_moyen_form['name']=='') {
                                                                                                                
                                                                                                                    $nouveauNom7 = $imagemoyen;
                                                                                                                } else {
                                                                                                                    $testdeplacer7 = move_uploaded_file($dossierTempo7, $dossierReception7);
                                                                                                                
                                                                                                                }
                                                                                                        /*************************IMAGE MOYEN ***********************/
                                                                                                            


                                                                                                                
                                                                                                                                    if(empty($dateverifbv)) {
                                                                                                                                        $dateverifbv = '00-00-0000';
                                                                                                                                    }

                                                                                                                                    if(empty($delais_form)) {
                                                                                                                                        $delais_form = '00-00-0000';
                                                                                                                                    }

                                                                                                                                    if(empty($date_mise_ajour)) {
                                                                                                                                        $date_mise_ajour = date('Y-m-d');
                              }


                          $this->entityManager->getRepository(MoyenDeLevage::class)->modifier_moyen_de_levage($numero,
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
                                                                                                      $nouveauNom7);

                  $notification2 = 'Le champ à été mise a jour';
                  header("Refresh:2");
                  
                 // var_dump($notification2);
                                                                                                     
    }

}
                                                                            
             }
              else
             {
               $notification3='Il vous manque la CMU du moyen de levage';
             }
                
      }       
 }
        // var_dump($resultat_recherches_uniques);
        return $this->render('fiche_de_vie/modification.html.twig', [
            'DescriptionMoyens'=>$description,
            'zone_services'=>$zone_service,
            'fournisseurs'=>$fournisseurs,
            'emplacements'=>$emplacements,
            'statusDuMoyens'=>$statusDuMoyen,
            'statusBVs'=>$statusBV,
            'motifBVs'=>$motifBVs,
            'pilotes'=>$pilotes,

            'description_bdd'=>$description_bdd,
            'numero_bdd'=>$numero_bdd,
            'cmu_bdd'=>$cmu_bdd,
            'zoneservice_bdd'=>$zoneservice_bdd,
            'fournisseurs_bdd'=>$fournisseurs_bdd,
            'observations'=>$observations,            

            'emplacements_bdd'=>$emplacements_bdd,
            'statusDuMoyen_bdd'=>$statusDuMoyen_bdd,
            'statusBV_bdd'=>$statusBV_bdd,
            'motifBVs_bdd'=>$motifBVs_bdd,
            'pilotes_bdd'=>$pilotes_bdd,
            'delais_bdd'=>$delais_bdd,
            'action_bdd'=>$actions_bdd,
            'commentaire'=>$commentaire,
            'dateverifbv'=>$dateverifbv,            
            'resultat_recherches_uniques'=>$resultat_recherches_uniques, 
            'certificat'=>$certificate,
            'ficheadequation'=>$ficheadequation,
            'mise_en_service'=>$mise_en_service,
            'rapport'=>$rapport,
            'plan'=>$plan,
            'notedecalcul'=>$notedecalcul,
            'imagemoyen'=>$imagemoyen,
            'statusDuMoyen2s'=>$statusDuMoyen2,

            'approbationmaintenance'=>$approbationmaintenance,
            'approbationqualite'=>$approbationqualite,
            'notification_validation_maintenance'=>$notification_validation_maintenance,
            'notification_validation_qualite'=>$notification_validation_qualite,
            'notification1'=>$notification1,
            'notification2'=>$notification2
       
        ]);
    }


}
