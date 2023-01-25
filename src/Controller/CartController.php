<?php

namespace App\Controller;

use App\Entity\Composant;
use App\Repository\ComposantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    /**
     * Retourne l'index du panier
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    #[Route('/cart/{id}', name: 'panier_add')]
    public function add(Request $request, Composant $composant) {
        return $this->render('cart/index.html.twig', [
            'composant' => $composant->getCategorie()->getPanierBddName()
            ]
        );
    }
}
