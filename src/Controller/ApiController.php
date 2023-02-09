<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/category', name: 'categorie')]
    public function index(CategorieRepository $categorieRepository): JsonResponse
    {
        $categories= $categorieRepository->findAll();
        return $this->Json( $categories );
    }

    #[Route('/composants/{id}', name: 'app_composant_by_composant')]
    /**
     * retourne le json prend l'id de la categorie et retourne les composants de cette catégorie
     */
    public function indexByComposant(Categorie $categorie): JsonResponse
    {

        $composants = $this->composantRepo->getResultsFilter($categorie)[0]->getQuery()->getResult();
        $message = $this->composantRepo->getResultsFilter($categorie)[1];
        $message2 = $this->composantRepo->getResultsFilter($categorie)[2];
        return $this->Json([$composants, $message, $message2]);
    }
}
