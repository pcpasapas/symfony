<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Composant;
use App\Form\ComposantFormType;
use App\Repository\CategorieRepository;
use App\Repository\ComposantRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComposantController extends AbstractController
{

    public function __construct(private CategorieRepository $categorieRepo, private ComposantRepository $composantRepo) {}


    #[Route('/composant', name: 'app_composant')]
    public function index(): Response
    {
        return $this->render('composant/index.html.twig', [
            'controller_name' => 'ComposantController',
        ]);
    }

    #[Route('/composants/{categorie}', name: 'app_composant_by_composant')]
    public function index_by_composant(Request $request): Response {
        $cat = $this->categorieRepo->findOneBy(['name' => $request->get('categorie')]);
        $cat_id = $cat->getId();
        $composants = $this->composantRepo->createQueryBuilder('p')
            ->andWhere('p.categorie = :categorie')
            ->setParameter('categorie', $cat_id)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
        return $this->Json($composants);
    }

    #[Route('/composantEdit', methods: ['POST'], name:'app_composant_edit')]
    public function edit(Request $request): Response
    {
        $id = $request->query->get('composant');
        $composant = $this->composantRepo->find($id);
        $composant_form = $this->createForm(ComposantFormType::class, $composant);

        return $this->redirectToRoute('category', [
            'composant_form' => $composant_form
        ]);

    }

    #[Route('/composantDelete', methods: ['POST'], name: 'app_composant_delete')]
    public function delete(ManagerRegistry $doctrine, Request $request): Response
    {
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
