<?php

namespace App\Controller;

use App\Entity\Composant;
use App\Form\ComposantFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComposantController extends AbstractController
{
    #[Route('/composant', name: 'app_composant')]
    public function index(): Response
    {
        return $this->render('composant/index.html.twig', [
            'controller_name' => 'ComposantController',
        ]);
    }

    #[Route('/composantEdit', methods: ['POST'], name:'app_composant_edit')]
    public function edit(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        $id = $request->query->get('composant');
        $composant = $em->getRepository(Composant::class)->find($id);
        $composant_form = $this->createForm(ComposantFormType::class, $composant);

        return $this->redirectToRoute('category', [
            'composant_form' => $composant_form
        ]);

    }

    #[Route('/composantDelete', methods: ['POST'], name: 'app_composant_delete')]
    public function delete(ManagerRegistry $doctrine, Request $request): Response
    {
        dump($request);
        $em = $doctrine->getManager();
        $id = $request->query->get('composant');
        $composant = $em->getRepository(Composant::class)->find($id);

        $em->remove($composant);
        $em->flush();
        $this->addFlash(
            'danger',
            'Le composant à été supprimé ...'
        );
        return $this->redirectToRoute('category');
    }
}
