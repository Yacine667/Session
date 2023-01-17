<?php

namespace App\Controller;

use App\Entity\Categorie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]

    public function index(ManagerRegistry $doctrine): Response
    {
        $categories = $doctrine->getRepository(Categorie::class)->findAll();

        return $this->render('categorie/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/categorie/{id}', name: 'detail_categorie')]

    public function detail(Categorie $categorie, ManagerRegistry $doctrine, Request $request): Response
    {   
        $categorie_id = $categorie->getId();
        $nomCategorie = $categorie->getNomCategorie();
        $modules = $categorie->getModules();

        return $this->render('categorie/detail.html.twig', [ 
            'nomCategorie'=>$nomCategorie,
            'categorie_id' => $categorie_id, 
            'modules'=> $modules 

        ]);
    }
}
