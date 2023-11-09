<?php

namespace App\Controller;

use App\Entity\MoyenDeLevage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ValiderController extends AbstractController
{


    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }



    /**
     * @Route("/valider", name="app_valider")
     */
    public function index(): Response
    {  
        $liste_recherche_maintenances=null;
        $liste_recherche_qualites=null;


       /* RECHERCHE LISTE DES MOYENS A VALIDER POUR LA QUALITE */
       $liste_recherche_qualites=$this->entityManager->getRepository(MoyenDeLevage::class)->recherche_valider_moyen_qualite();
       /* RECHERCHE LISTE DES MOYENS A VALIDER POUR MAINTENANCE */
       $liste_recherche_maintenances=$this->entityManager->getRepository(MoyenDeLevage::class)->recherche_valider_moyen_maintenance();


    //   var_dump( $liste_recherche_maintenance);


        return $this->render('valider/index.html.twig', [
            'liste_recherche_maintenances' => $liste_recherche_maintenances,
            'liste_recherche_qualites' => $liste_recherche_qualites,
        ]);
    }




     /**
     * @Route("/supprimer/{numero}", name="app_supp")
     */
    public function delete($numero, Request $request): Response
    {  
        

            if ($request->isMethod('POST')) 
            {
                        $resultat_option=$request->request->get('inlineRadioOptions');
                      
                        if($resultat_option=='oui')
                        {
                            $this->entityManager->getRepository(MoyenDeLevage::class)->delete_moyen($numero);
                            return $this->redirectToRoute('app_valider');

                               /***********************************FONCTION MAIL*********************************************/
                                 /*Variable du destinataire*/
                                                          /*mail indus*/
                                                          $to ='kit.survieqhse18@gmail.com, ajustinmarie@gmail.com';
                                                          /*le sujet du mail*/
                                                          $subject = "Demande validation d'un moyen de levage";
                                                          /*message*/
                                                          /* pour afficher du php dans tes mail voici le secret la concatenation */
                                                          $message=".<p>Le moyen de levage numero:$numero a été supprimé par le service qualité ou maintenance<br/>
                                                          <a href=\"wwww.\">lien</a><br/> </p>";                             
                                                          $header ="MIME Version 1.0\r\n";
                                                      /*mettre le lien du fichier style css */
                                                      $header .="Content-type: text/html; charset=UTF-8\r\n";
                                                      /*qui envoie le mail ? reply to=adresse pour celui qui recoit le mail pour qu'il puisse renvoyé au destinataire */                             
                                                      $header .="From: no-reply@qualite-it.com"."\r\n"."Reply-To: adressepoubelle@gmail.com"."\r\n"."X-mailer: PHP/".phpversion();
                         
                                                      mail($to,$subject,$message, $header); 
                                                      /*********************************FONCTION MAIL***********************************************/


                        }
                        else
                        {
                            return $this->redirectToRoute('app_valider');
                        }
            }
                //   $liste_recherche_maintenances=null;
                //   $liste_recherche_qualites=null;

                /* RECHERCHE LISTE DES MOYENS A VALIDER POUR LA QUALITE */
                //  $liste_recherche_qualites=$this->entityManager->getRepository(MoyenDeLevage::class)->recherche_valider_moyen_qualite();
                /* RECHERCHE LISTE DES MOYENS A VALIDER POUR MAINTENANCE */
                // $liste_recherche_maintenances=$this->entityManager->getRepository(MoyenDeLevage::class)->recherche_valider_moyen_maintenance();

                //   var_dump( $liste_recherche_maintenance);

        return $this->render('valider/supprimer.html.twig', [
              'numero'=>$numero          
        ]);
    }















}

