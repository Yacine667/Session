<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formateur;
use App\Form\FormateurType;
use App\Repository\SessionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormateurController extends AbstractController
{
    #[Route('/formateur', name: 'app_formateur')]
    public function index(ManagerRegistry $doctrine, Formateur $formateur = null, Request $request): Response
    {
        if(!$formateur) {
            $formateur = new Formateur();
        }

        $formateurs = $doctrine->getRepository(Formateur::class)->findAll();
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $formateur = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($formateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_formateur');
        }
        return $this->render('formateur/index.html.twig', [
            'formateurs' => $formateurs,
            'formAddFormateur' => $form->createView()
        ]);
    }

    #[Route('/formateur/{id}', name: 'detail_formateur')]

    public function detail(Formateur $formateur, ManagerRegistry $doctrine, SessionRepository $sr, Request $request): Response
    {   
        $formateur_id = $formateur->getId();
        $nomFormateur = $formateur->getNomFormateur();
        $prenomFormateur = $formateur->getPrenomFormateur();
        $mailFormateur = $formateur->getMailFormateur();
        $telFormateur = $formateur->getTelFormateur(); 
        $sessions = $formateur->getSessions();  
        return $this->render('formateur/detail.html.twig', [
            'telFormateur' => $telFormateur,
            'mailFormateur' => $mailFormateur,
            'prenomFormateur' => $prenomFormateur,  
            'nomFormateur'=>$nomFormateur,
            'formateur_id' => $formateur_id,
            'sessions' => $sessions
             

        ]);
    }
    
}
