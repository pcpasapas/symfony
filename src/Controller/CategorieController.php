<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface as SerializationSerializerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    #[Route('/api/categorie', name: 'api_categorie')]
    public function api(CategorieRepository $categorieRepository): JsonResponse
    {
        $categories = $categorieRepository->findAll();
        return $this->Json($categories);
    }


    #[Route('/categorieDelete', methods: ['POST'], name: 'app_categorie_delete')]
    public function delete(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        $id = $request->query->get('categorie');
        $categorie = $em->getRepository(Categorie::class)->find($id);

        $em->remove($categorie);
        $em->flush();
        $this->addFlash(
            'danger',
            'La catégorie a été supprimée ...'
        );
        return $this->redirectToRoute('category');
    }
}
