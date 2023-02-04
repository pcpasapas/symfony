<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Composant;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    /**
     * Retourne la page index du panier
     */
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    #[Route('/cart/{id}', name: 'panier_add')]
    public function add(Composant $composant, Security $security, PanierRepository $panierRepo): Response
    {
        $currentUser = $security->getUser();
        if ($currentUser === null) {
            $panier = $panierRepo->Find(1);
        } else {
            $panier = $panierRepo->findOneBy(['user' => $security->getUser()]);
        }
        $panier->setComposant($composant);
        $panierRepo->save($panier, true);
        flash()->translate([], 'fr')->addSuccess("L'article a bien été ajouté à votre configuration");
        return $this->redirectToRoute('configurateur');
    }

    #[Route('/cart/remove/{categorie}', name: 'panier_remove')]
    public function remove(PanierRepository $panierRepo, Security $security, Request $request): Response
    {
        $currentUser = $security->getUser();
        if ($currentUser === null) {
            $panier = $panierRepo->Find(1);
        } else {
            $panier = $panierRepo->findOneBy(['user' => $security->getUser()]);
        }
        $set = 'set' . $request->get('categorie');
        $panier->$set(null);
        $panierRepo->save($panier, true);
        flash()->translate([], 'fr')->addInfo("L'article a bien été retiré de votre configuration");
        return $this->redirectToRoute('configurateur');
    }
}
