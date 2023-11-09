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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class EnregistrementController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }

    /**
     * @Route("/enregistrement", name="app_enregistrement")
     */
    public function index(Request $request): Response
    {
         
        $notification=null;     
        $numero=null;
        $cmu=null;
        $dateverifbv=null;
        $observations=null;
        $delais=null;
        $actions=null;
        $commentaire=null;
        $description_form=null;
        $zone_service_form=null;
        $fournisseurs_form=null;
        $emplacement_form=null;
        $statusmoyen_form=null;
        $statusbv_form=null;
        $motifBV_form=null;
        $pilote_form=null;
        $notification1=null;
        $notification2=null;
        $notification3=null;
        $notification4=null;
        $notification5=null;
        $notification6=null;
        $notification7=null;
        $user_name=null;

        $rapportbv=null;
        $certificate=null;
        $adequation=null;
        $mise_en_service=null;
        $plan=null;
        $note_de_calcul=null;
        $img_moyen=null;
         
        $nom_fichier1=null;
        $nom_fichier2=null;
        $nom_fichier3=null;
        $nom_fichier4=null;
        $nom_fichier5=null;
        $nom_fichier6=null;
        $nom_fichier7=null;

        $notification8=null;
        $statusDuMoyen2=null;

        if ($request->isMethod('POST')) 
        {
                                                $numero=htmlspecialchars($request->request->get('numero'));
                                                $description_form=htmlspecialchars($request->request->get('description'));
                                                $cmu=htmlspecialchars($request->request->get('cmu'));
                                                $zone_service_form=htmlspecialchars($request->request->get('zone_service'));
                                                $fournisseurs_form=htmlspecialchars($request->request->get('fournisseurs'));
                                                $emplacement_form=htmlspecialchars($request->request->get('emplacement'));
                                                $statusmoyen_form=htmlspecialchars($request->request->get('statusmoyen'));
                                                $dateverifbv=htmlspecialchars($request->request->get('dateverifbv'));
                                                $statusbv_form=htmlspecialchars($request->request->get('statusbv'));
                                                $motifBV_form=htmlspecialchars($request->request->get('motifBV'));
                                                $observations=htmlspecialchars($request->request->get('observations'));
                                                $pilote_form=htmlspecialchars($request->request->get('pilote'));
                                                $delais=htmlspecialchars($request->request->get('delais'));
                                                $actions=htmlspecialchars($request->request->get('actions'));
                                                $commentaire=htmlspecialchars($request->request->get('commentaire'));
                                                $user_name=htmlspecialchars($request->request->get('user_name'));
                                                /***************************PIECE JOINTES***************************/
                                                $rapportbv=$request->files->get('rapportbv');
                                                $certificate=$request->files->get('certificate');
                                                $adequation=$request->files->get('adequation');
                                                $mise_en_service=$request->files->get('mise_en_service');
                                                $plan=$request->files->get('plan');
                                                $note_de_calcul=$request->files->get('note_de_calcul');
                                                $img_moyen=$request->files->get('img_moyen');

                                             
                                               var_dump($numero);

                                                $taille_autorise = 2000000000;
                                                /*****************************rapportbv*******************************/                                                       
                                                $taille1=$rapportbv['size'];
                                                $nom_fichier1 =$rapportbv['name'];
                                                $dossierTempo1 =$rapportbv['tmp_name']; 
                                                /*****************************certificate*****************************/    
                                                $taille2=$certificate['size'];
                                                $nom_fichier2 =$certificate['name'];
                                                $dossierTempo2 =$certificate['tmp_name']; 
                                                /*** **************************adequation*****************************/    
                                                $taille3=$adequation['size'];
                                                $nom_fichier3 =$adequation['name'];
                                                $dossierTempo3=$adequation['tmp_name']; 
                                                /*****************************mise_en_service*****************************/    
                                                $taille4=$mise_en_service['size'];
                                                $nom_fichier4=$mise_en_service['name'];
                                                $dossierTempo4=$mise_en_service['tmp_name']; 
                                                    /*****************************plan*****************************/    
                                                $taille5=$plan['size'];
                                                $nom_fichier5=$plan['name'];
                                                $dossierTempo5=$plan['tmp_name']; 
                                                /*****************************note_de_calcul*****************************/    
                                                $taille6=$note_de_calcul['size'];
                                                $nom_fichier6=$note_de_calcul['name'];
                                                $dossierTempo6=$note_de_calcul['tmp_name']; 
                                                /*****************************img_moyen*****************************/    
                                                $taille7=$img_moyen['size'];
                                                $nom_fichier7=$img_moyen['name'];
                                                $dossierTempo7=$img_moyen['tmp_name']; 
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
                                                $nouveauNom1 = time();
                                                $nouveauNom1 = '1-' . $nouveauNom1 . $extension1;
                                                $dossierReception1 = 'upload/' . $nouveauNom1;
                                                /*****************************certificate*****************************/
                                                $nouveauNom2 = time();
                                                $nouveauNom2 = '2-' . $nouveauNom2 . $extension2;
                                                $dossierReception2 = 'upload/' . $nouveauNom2;
                                                /*****************************adequation*****************************/
                                                $nouveauNom3 = time();
                                                $nouveauNom3 = '3-' . $nouveauNom3 . $extension3;
                                                $dossierReception3 = 'upload/' . $nouveauNom3;
                                                /*****************************mise_en_service*****************************/
                                                $nouveauNom4 = time();
                                                $nouveauNom4 = '4-' . $nouveauNom4 . $extension4;
                                                $dossierReception4 = 'upload/' . $nouveauNom4;
                                                /*****************************plan*****************************/
                                                $nouveauNom5 = time();
                                                $nouveauNom5 = '5-' . $nouveauNom5 . $extension5;
                                                $dossierReception5 = 'upload/' . $nouveauNom5;
                                                /*****************************note_de_calcul*****************************/
                                                $nouveauNom6 = time();
                                                $nouveauNom6 = '6-' . $nouveauNom6 . $extension6;
                                                $dossierReception6 = 'upload/' . $nouveauNom6;
                                                /*****************************img_moyen*****************************/
                                                $nouveauNom7 = time();
                                                $nouveauNom7 = '7-' . $nouveauNom7 . $extension7;
                                                $dossierReception7 = 'upload/' . $nouveauNom7;



                                                if(!in_array($extension1, $extension_autoriser) or !in_array($extension2, $extension_autoriser) or !in_array($extension3, $extension_autoriser) or !in_array($extension4, $extension_autoriser) or !in_array($extension5, $extension_autoriser) or !in_array($extension6, $extension_autoriser) or !in_array($extension7, $extension_autoriser)) {
                                                    // echo'Extension Non autorisé!';
                                                    $notification4 = 'Veuillez verifier les extensions de vos pièces jointes (png,jpg,pdf)';
                                                } elseif ($taille1 > $taille_autorise or $taille2 > $taille_autorise or $taille3 > $taille_autorise or $taille4 > $taille_autorise or $taille5 > $taille_autorise or $taille6 > $taille_autorise or $taille7 > $taille_autorise) {
                                                    // echo 'Le fichier est trop volumineux!';
                                                    $notification5 = 'Une de vos pièces jointes est trop volumineux';
                                                } else {


                                                   if($rapportbv['name'] == null or  $rapportbv['name']==''){
                                                   $nouveauNom1='';
                                                   }else{
                                                   $testdeplacer1 = move_uploaded_file($dossierTempo1, $dossierReception1);                                                    
                                                   }

                                                   if($certificate['name'] == null or $certificate['name']==''){                                                                                                                
                                                   $nouveauNom2='';
                                                   }else{
                                                   $testdeplacer2 = move_uploaded_file($dossierTempo2, $dossierReception2);
                                                   }

                                                   if($adequation['name'] == null or $adequation['name']==''){                                                   
                                                   $nouveauNom3='';
                                                   }else{                                                
                                                    $testdeplacer3 = move_uploaded_file($dossierTempo3, $dossierReception3);
                                                   }

                                                   if($mise_en_service['name'] == null or $mise_en_service['name']=='') {
                                                    $nouveauNom4 ='';
                                                    }else{                                                
                                                    $testdeplacer4 = move_uploaded_file($dossierTempo4, $dossierReception4);
                                                    }

                                                    if($plan['name']==NULL or $plan['name']=='') {                    
                                                        $nouveauNom5 ='';
                                                    } 
                                                    else
                                                    {            
                                                        $testdeplacer5 = move_uploaded_file($dossierTempo5, $dossierReception5);
                                                    }

                                                    if($note_de_calcul['name'] == null or $note_de_calcul['name']=='') {
                                                        $nouveauNom6='';
                                                    } else {                                                        
                                                        $testdeplacer6 = move_uploaded_file($dossierTempo6, $dossierReception6);
                                                    }

                                                    if($img_moyen['name'] == null or  $img_moyen['name']=='') {
                                                                                                                
                                                        $nouveauNom7 ='';
                                                    } else {
                                                        $testdeplacer7 = move_uploaded_file($dossierTempo7, $dossierReception7);                                                 
                                                    }  
                                                }              

                                                $approbationqualite = 0;
                                                $appobationmaintenance = 0;
                                                $dateenregistrement = date('Y-m-d');
                                                $date_mise_ajour = null;
                                                $tatut_final = 'non-approuvé';

                                                if(empty($dateverifbv)) {
                                                    $dateverifbv = '00-00-0000';
                                                }

                                                if(empty($delais)) {
                                                    $delais = '00-00-0000';
                                                }

                                                if(empty($delais)) {
                                                    $delais = '00-00-0000';
                                                }

                                                if(empty($date_mise_ajour)) {
                                                    $date_mise_ajour = '00-00-0000';
                                                }

                                                //  $insertion_voiture=$this->entityManager->getRepository(Voitures::class)->insertion($nomdevoiture, $prix, $anneecirculation, $kilometrage, $contact, $nouveauNom1,$nouveauNom2,$nouveauNom3, $nouveauNom4, $moteur, $transmission, $carrosserie);
                                        
                                                
                                                $insertion_moyen_de_levage = $this->entityManager->getRepository(MoyenDeLevage::class)->insertion(
                                                    $user_name,
                                                    $numero,
                                                    $description_form,
                                                    $cmu,
                                                    $zone_service_form,
                                                    $fournisseurs_form,
                                                    $emplacement_form,
                                                    $statusmoyen_form,
                                                    $dateverifbv,
                                                    $statusbv_form,
                                                    $motifBV_form,
                                                    $observations,
                                                    $pilote_form,
                                                    $delais,
                                                    $actions,
                                                    $commentaire,
                                                    $nouveauNom2,
                                                    $nouveauNom3,
                                                    $nouveauNom1,
                                                    $nouveauNom5,
                                                    $nouveauNom6,
                                                    $nouveauNom7,
                                                    $approbationqualite,
                                                    $appobationmaintenance,
                                                    $dateenregistrement,
                                                    $date_mise_ajour,
                                                    $tatut_final,
                                                    $nouveauNom4
                                                ); 
                                                $notification6 = 'Le moyen de levage à bien été enregistrer';
                                                header("Refresh:3");
                                             

                    
                            
    }
        

        

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
    /* STATUS DU MOYEN 2 */
    $statusDuMoyen2=$this->entityManager->getRepository(StatusMoyen2::class)->findAll();
    /* STATUS BV */
    $statusBV=$this->entityManager->getRepository(StatusBv::class)->findAll();
    /* MOTIF BV */
    $motifBVs=$this->entityManager->getRepository(MotifBV::class)->findAll();
     /* PILOTE */
     $pilotes=$this->entityManager->getRepository(User::class)->findAll();

    // var_dump($rapportbv);


        return $this->render('enregistrement/index.html.twig', [
            'DescriptionMoyens'=>$description,
            'zone_services'=>$zone_service,
            'fournisseurs'=>$fournisseurs,
            'emplacements'=>$emplacements,
            'statusDuMoyens'=>$statusDuMoyen,
            'statusBVs'=>$statusBV,
            'motifBVs'=>$motifBVs,
            'pilotes'=>$pilotes,
            'numero'=>$numero,
            'cmu'=>$cmu,
            'dateverifbv'=>$dateverifbv,
            'observations'=>$observations,
            'delais'=>$delais,
            'actions'=>$actions,
            'commentaire'=>$commentaire,
            'description_form'=>$description_form,
            'zone_service_form'=>$zone_service_form,
            'fournisseurs_form'=>$fournisseurs_form,
            'emplacement_form'=>$emplacement_form,
            'statusmoyen_form'=>$statusmoyen_form,
            'statusbv_form'=>$statusbv_form,
            'motifBV_form'=>$motifBV_form,
            'pilote_form'=>$pilote_form,
            'notification1'=>$notification1,
            'notification2'=>$notification2,
            'notification3'=>$notification3,
            'notification4'=>$notification4,
            'notification5'=>$notification5,
            'notification6'=>$notification6,
            'notification7'=>$notification7,
            'notification8'=>$notification8,
            'rapportbv'=>$rapportbv,
            'certificate'=>$nom_fichier2,
            'mise_en_service'=>$nom_fichier4,
            'plan'=>$nom_fichier5,
            'note_de_calcul'=>$nom_fichier6,
            'img_moyen'=>$nom_fichier7,
            'adequation'=>$nom_fichier3,
            'statusDuMoyen2s'=>$statusDuMoyen2
        ]);

    

    }


}