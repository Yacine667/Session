<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Session;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use App\Repository\ModuleRepository;
use App\Repository\SessionRepository;
use App\Repository\StagiaireRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
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

    public function detail(Session $session, StagiaireRepository $sr, ModuleRepository $mr): Response
    {
        $session_id = $session->getId();
        $stagiairesInscrits = $session->getStagiaires();
        $nomSession = $session->getNomSession();
        $programme = $session->getProgramme();
        $modules = $programme->getModules();
        $modulesLibres = $mr->findModulesLibresBySessionId($session_id);
        $stagiairesNonInscrits = $sr->findStagiairesNonInscritsBySessionId($session_id);   
        return $this->render('session/detail.html.twig', [
            'stagiairesInscrits' => $stagiairesInscrits,
            'programme' => $programme,
            'modules' => $modules,
            'modulesLibres' => $modulesLibres,
            'stagiairesNonInscrits' => $stagiairesNonInscrits,  
            'nomSession'=>$nomSession,
            'session_id' => $session_id          
        ]);
    }

    #[Route('/session/{id}/ajouterProgramme/{moduleId}', name: 'ajouter_programme')]
    public function ajouterProgramme(ManagerRegistry $doctrine, Session $session, $moduleId)
    {
        if(isset($_POST['submitProgramme'])){
            $duree =filter_input(INPUT_POST,"duree",FILTER_VALIDATE_INT);
            $entityManager = $doctrine->getManager();
            $module = $entityManager->getRepository(Module::class)->find($moduleId);
            $programme = new Programme();
            $programme->setDureeProgramme($duree);
            $programme->addModule($module);
            $programme->addSession($session);
            $entityManager->persist($programme);
            $entityManager->flush();
            return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
        }
    }


    #[Route('/session/{id}/inscrire/{stagiaireId}', name: 'inscrire_stagiaire')]

    public function inscrireStagiaire(ManagerRegistry $doctrine, Session $session, $stagiaireId)
    {
        $entityManager = $doctrine->getManager();
        $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($stagiaireId);
        $session->addStagiaire($stagiaire);
        $entityManager->flush();

        return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
    }


    #[Route('/session/{id}/desinscrire/{stagiaireId}', name: 'desinscrire_stagiaire')]

    public function desinscrireStagiaire(ManagerRegistry $doctrine, Session $session, $stagiaireId)
    {
        $entityManager = $doctrine->getManager();
        $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($stagiaireId);
        $session->removeStagiaire($stagiaire);
        $entityManager->flush();

        return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
    }


    #[Route('/session/{id}/delete', name: 'delete_session')]

    public function delete(ManagerRegistry $doctrine, Session $session) {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute('app_session');
    }
}
