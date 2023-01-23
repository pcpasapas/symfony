<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Composant;
use App\Form\CategorieFormType;
use App\Form\ComposantFormType;
use App\Repository\CategorieRepository;
use App\Repository\ComposantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Migrations\Configuration\EntityManager\ManagerRegistryEntityManager;


class PagesController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {}

    #[Route('/', name: 'homepage')]
    public function index(Request $request): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    #[Route('/category', name: 'category')]
    public function category(
        CategorieRepository $categorieRepository,
        ComposantRepository $composantRepository,
        Request $request,
        ManagerRegistry $doctrine
        ): Response

    {
        // Récupération des catégories
        $category = new Categorie();
        $form = $this->createForm(CategorieFormType::class, $category);
        $form->handleRequest($request);
        // Creation d'une catégorie
        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash(
                'success',
                'La catégorie a été créee ...'
            );
            $this->entityManager->persist($category);
            $this->entityManager->flush();

            return $this->redirectToRoute('category');
        }

        // Récupération des composants
        dump($request->get('compossant'));
        if ($request->get('composant') === null) {
            $composant = new Composant();
        }else {
            $em = $doctrine->getManager();
            $id = $request->query->get('composant');
            $composant = $em->getRepository(Composant::class)->find(1);
        }

        $composant_form = $this->createForm(ComposantFormType::class, $composant);
        $composant_form->handleRequest($request);

        // Création d'un composant
        if ($composant_form->isSubmitted() && $composant_form->isValid()) {
            $this->addFlash(
                'success',
                'Le composant a été crée ou modifié...'
            );
            $this->entityManager->persist($composant);
            $this->entityManager->flush();
            return $this->redirectToRoute('category');
        }

        return $this->render('pages/categorie.html.twig', [
            'categories' => $categorieRepository->findAll(),
            'composants' => $composantRepository->findAll(),
            'category_form' => $form,
            'composant_form' => $composant_form
        ]);
    }

    #[Route('/astuces', name: 'astuces')]
    public function astuces(Request $request): Response
    {
        return $this->render('pages/astuces.html.twig');
    }

    #[Route('/tests', name: 'tests')]
    public function tests(Request $request): Response
    {
        return $this->render('pages/tests.html.twig');
    }


}
