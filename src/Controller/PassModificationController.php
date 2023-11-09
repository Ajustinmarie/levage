<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use App\Form\PasswordModificationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PassModificationController extends AbstractController
{


    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }


    /**
     * @Route("/pass/modification", name="app_pass_modification")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {

                $notification=null;

                $user=$this->getUser();
                $form=$this->createForm(PasswordModificationType::class, $user);

                $form->handleRequest($request);
                
if ($form->isSubmitted() && $form->isValid()) {


    // dd($form->get('old_password')->getData());
    $old_password = $form->get('old_password')->getData();

    if($encoder->isPasswordValid($user, $old_password)) {
        $new_password = $form->get('new_password')->getData();
        $encode_new_password = $encoder->encodePassword($user, $new_password);


        $user->setPassword($encode_new_password);


        // $this->entityManager->persist($user);
        $this->entityManager->flush();
        $notification = 'Votre mot de passe à bien été mis a jour';
    } else
     {
        $notification = "Votre mot de passe actuel n'est pas le bon";
    }

}
    return $this->render('pass_modification/index.html.twig', [
        'form' => $form->createView(),
        'notification' => $notification

    ]);

        }
}
