<?php

namespace App\Controller;

use App\Entity\Composant;
use App\Entity\Panier;
use App\Repository\PanierRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    /**
     * Retourne la page index du panier
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    #[Route('/cart/{id}', name: 'panier_add')]
    public function add(Composant $composant, PanierRepository $panierRepo): Response {
        $panier = $panierRepo->find(1);
        $panier->setComposant($composant);
        $panierRepo->save($panier, true);
        return $this->redirectToRoute('configurateur');
    }

    #[Route('/cart/remove/{id}', name: 'panier_remove')]
    public function remove(Composant $composant, PanierRepository $panierRepo): Response {
        dump($composant);
        return $this->redirectToRoute('configurateur');
    }
}
