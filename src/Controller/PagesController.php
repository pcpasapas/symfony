<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Categorie;
use App\Entity\Composant;
use App\Entity\Panier;
use App\Form\CategorieFormType;
use App\Form\ComposantFormType;
use App\Repository\PanierRepository;
use App\Repository\CategorieRepository;
use App\Repository\ComposantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PagesController extends AbstractController
{
    public function __construct(
    private CategorieRepository $categorieRepository,
    private ComposantRepository $composantRepository,
    private PanierRepository $panierRepository
    )
    {}

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    #[Route('/category', name: 'category')]
    public function category(

        Request $request,
        ManagerRegistry $doctrine,
        EntityManagerInterface $entityManager
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
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category');
        }

        // Récupération des composants
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
            $entityManager->persist($composant);
            $entityManager->flush();
            return $this->redirectToRoute('category');
        }

        return $this->render('pages/categorie.html.twig', [
            'categories' => $this->categorieRepository->findAll(),
            'composants' => $this->composantRepository->findAll(),
            'category_form' => $form,
            'composant_form' => $composant_form
        ]);
    }

    #[Route('/astuces', name: 'astuces')]
    public function astuces(): Response
    {
        return $this->render('pages/astuces.html.twig');
    }

    #[Route('/tests', name: 'tests')]
    public function tests(): Response
    {
        return $this->render('pages/tests.html.twig');
    }

    #[Route('/configurateur', name: 'configurateur')]
    public function configurateur(PanierRepository $panierRepo, ComposantRepository $composant, Security $security)
    {
        // Recuperation du panier de l'utilisateur ou alors création d'un panier
        $currentUser = $security->getUser();
        if ($currentUser == null) {
            $panier = $this->panierRepository->Find(1);
        } else {
            $panier = $this->panierRepository->findOneBy(['user' => $security->getUser()]);
            if (!$panier) {
                $panier = new Panier();
                $panier->setUser($security->getUser());
                $panierRepo->save($panier, true);
                $panier = $this->panierRepository->findOneBy(['user' => $currentUser]);
            }
        }

        return $this->render('pages/configurateur.html.twig',
         [
            'categories' => $this->categorieRepository->findAll(),
            'panier' => [
                'boitier' => (array) $panier->getBoitier(),
                'alimentation' => (array) $panier->getAlimentation(),
                'processeur' => (array) $panier->getProcesseur(),
                'carte_mere' => (array) $panier->getCarteMere(),
                'carte_graphique' => (array) $panier->getCarteGraphique(),
                'ram' => (array) $panier->getRam(),
                'ssd' => (array) $panier->getSsd(),
                'hdd' => (array) $panier->getHdd(),
            ],
         ]
        );
    }


}
