<?php

namespace App\Controller;

use App\Entity\Session;
use App\Repository\SessionRepository;
use App\Repository\StagiaireRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    
    public function index(ManagerRegistry $doctrine, SessionRepository $sr): Response
    {
        $today = date('d/m/Y');
        // Récuperer les sessions en base de données
        $pastSessions = $sr->findPastSessions();
        $currentSessions = $sr->findCurrentSessions();
        $upcomingSessions = $sr->findUpcomingSessions();
        return $this->render('session/index.html.twig', [
            'today' => $today,
            'pastSessions' => $pastSessions,
            'currentSessions' => $currentSessions,
            'upcomingSessions' => $upcomingSessions,
        ]);
    }

    #[Route('/session/{id}', name: 'detail_session')]

    public function detail(Session $session, StagiaireRepository $sr): Response
    {
        $session_id = $session->getId();
        $stagiairesInscrits = $session->getStagiaires();
        $nomSession = $session->getNomSession();
        $programme = $session->getProgramme();
        $modules = $programme->getModules();
        $stagiairesNonInscrits = $sr->findStagiairesNonInscritsBySessionId($session_id);   
        return $this->render('session/detail.html.twig', [
            'stagiairesInscrits' => $stagiairesInscrits,
            'programme' => $programme,
            'modules' => $modules,
            'stagiairesNonInscrits' => $stagiairesNonInscrits,  
            'nomSession'=>$nomSession,
            'session_id' => $session_id          
        ]);
    }

    #[Route('/session/{id}/delete', name: 'delete_session')]

    public function delete(ManagerRegistry $doctrine, Session $session) {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute('app_session');
    }
}
