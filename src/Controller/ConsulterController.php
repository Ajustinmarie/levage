<?php

namespace App\Controller;

use App\Entity\DescriptionMoyen;
use App\Entity\Emplacement;
use App\Entity\Fournisseur;
use App\Entity\MotifBV;
use App\Entity\StatusBv;
use App\Entity\StatusMoyen;
use App\Entity\User;
use App\Entity\ZoneService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsulterController extends AbstractController
{


    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }



    /**
     * @Route("/consulter", name="app_consulter")
     */
    public function index(Request $request): Response
    {

        $numero=null;
        $zone_service_form=null;
        $emplacement_form=null;
        $fournisseurs_form=null;
        $cmuinf_form=null;
        $description_form=null;
        $statusmoyen_form=null;
        $statusbv_form=null;
        $cmusupp_form=null;
        $motifBV_form=null;
        $pilote_form=null;
        $delais_form=null;
        $cmuinf=null;
        $cmusupp=null;
        $delais=null;
        $notification1=null;


        if ($request->isMethod('POST')) 
        {            
            
            $numero=htmlspecialchars($request->request->get('numero'));
            $zone_service_form=htmlspecialchars($request->request->get('zone_service'));
            $emplacement_form=htmlspecialchars($request->request->get('emplacement'));
            $fournisseurs_form=htmlspecialchars($request->request->get('fournisseurs'));
            $cmuinf=htmlspecialchars($request->request->get('cmuinf'));
            $description_form=htmlspecialchars($request->request->get('description'));
            $statusmoyen_form=htmlspecialchars($request->request->get('statusmoyen'));
            $statusbv_form=htmlspecialchars($request->request->get('statusbv'));
            $cmusupp=htmlspecialchars($request->request->get('cmusupp'));
            $motifBV_form=htmlspecialchars($request->request->get('motifBV'));
            $pilote_form=htmlspecialchars($request->request->get('pilote'));
            $delais=htmlspecialchars($request->request->get('delais'));




            if(isset($cmuinf) && is_numeric($cmuinf) AND isset($cmusupp) && is_numeric($cmusupp))
            {
               
               
            }
            else
            {
                
                    $notification1="Vous devez inscrire un numero dans les champs CMU";
                
            }



            

        }




             /* DESCRIPTION DU MOYEN */
             $description=$this->entityManager->getRepository(DescriptionMoyen::class)->description_moyen_de_levage();
             /* ZONE /SERVICE */
             $zone_service=$this->entityManager->getRepository(ZoneService::class)->zone_service();
             /* FOURNISSEURS */
             $fournisseurs=$this->entityManager->getRepository(Fournisseur::class)->fournisseurs();
             /* EMPLACEMENT */
             $emplacements=$this->entityManager->getRepository(Emplacement::class)->emplacements();
             /* STATUS DU MOYEN */
             $statusDuMoyen=$this->entityManager->getRepository(StatusMoyen::class)->statusmoyen();
              /* STATUS BV */
              $statusBV=$this->entityManager->getRepository(StatusBv::class)->statut_bv();
              /* MOTIF BV */
              $motifBVs=$this->entityManager->getRepository(MotifBV::class)-> motifBV();
               /* PILOTE */
               $pilotes=$this->entityManager->getRepository(User::class)->pilote();


        return $this->render('consulter/index.html.twig', [
            'DescriptionMoyens'=>$description,
            'zone_services'=>$zone_service,
            'fournisseurs'=>$fournisseurs,
            'emplacements'=>$emplacements,
            'statusDuMoyens'=>$statusDuMoyen,
            'statusBVs'=>$statusBV,
            'motifBVs'=>$motifBVs,
            'pilotes'=>$pilotes,
            'zone_service_form'=>$zone_service_form,
             'numero'=>$numero,
             'emplacement_form'=>$emplacement_form,
             'fournisseurs_form'=>$fournisseurs_form,
             'cmuinf'=>$cmuinf,
             'description_form'=>$description_form,
             'statusmoyen_form'=>$statusmoyen_form,
             'statusbv_form'=>$statusbv_form,
              'cmusupp'=>$cmusupp,
              'motifBV_form'=>$motifBV_form,
              'delais'=>$delais,
              'pilote_form'=>$pilote_form,
              'notification1'=>$notification1,
        ]);
    }
}
