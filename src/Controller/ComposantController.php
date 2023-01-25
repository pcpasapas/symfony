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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComposantController extends AbstractController
{

    public function __construct(private CategorieRepository $categorieRepo, private ComposantRepository $composantRepo) {}


    #[Route('/composant', name: 'app_composant')]
    public function index(): Response
    {
        $composants = $this->composantRepo->createQueryBuilder('p')
        ->andWhere('p.categorie = :categorie')
        ->setParameter('categorie', 1)
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
        return $this->render('composant/index.html.twig');
    }

    #[Route('/composants/{id}', name: 'app_composant_by_composant')]
    /**
     * retourne le json prend l'id de la categorie et retourne les composants de cette catégorie
     * @param Categorie $categorie
     * @return JsonResponse
     */
    public function index_by_composant(Categorie $categorie): JsonResponse {
        $composants = $this->composantRepo->createQueryBuilder('p')
            ->andWhere('p.categorie = :categorie')
            ->setParameter('categorie', $categorie)
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
