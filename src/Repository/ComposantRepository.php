<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Composant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

/**
 * @extends ServiceEntityRepository<Composant>
 *
 * @method Composant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Composant|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<Composant> findAll()
 * @method array<Composant> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class ComposantRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private PanierRepository $panierRepo,
        private Security $security
    ) {
        parent::__construct($registry, Composant::class);
    }

    public function save(Composant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Composant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getResultsFilter($categorie)
    {
        $message = '';
        $message2 = '';
        // retrouve les composants en fonction de la categorie choisie
        $composants = $this->createQueryBuilder('p')
            ->andWhere('p.categorie = :categorie')
            ->setParameter('categorie', $categorie);

        // trouve le panier de l'utlisateur
        $currentUser = $this->security->getUser();
        if ($currentUser === null) {
            $panier = $this->panierRepo->Find(1);
        } else {
            $panier = $this->panierRepo->findOneBy(['user' => $currentUser]);
        }
        // si on veut voir les boitiers
        if ($categorie->getId() == '1') {
            // si la carte mere est deja dans le panier
            $carteMereChoisie = $panier->getCarteMere();
            if ($carteMereChoisie) {
                $message =
                'Les boitiers affich??s sont filtr??s pour afficher seulement ceux qui sont
                compatibles avec votre carte m??re. Format : ' . $carteMereChoisie->getFormat();
                $composants = $composants
                    ->andWhere('p.format LIKE :format')
                    ->setParameter('format', '%' . $carteMereChoisie->getFormat() . '%');
            }
        }

        // si on veut voir les processeurs
        if ($categorie->getId() == '3') {
            // si la carte mere est deja dans le panier
            $carteMereChoisie = $panier->getCarteMere();
            if ($carteMereChoisie) {
                $message = 'Les processeurs affich??s sont filtr??s pour afficher seulement ceux qui sont
                compatibles avec votre carte m??re. Socket : ' . $carteMereChoisie->getSocket();
                $composants = $composants
                    ->andWhere('p.socket = :socket')
                    ->setParameter('socket', $carteMereChoisie->getSocket());
            }
        }
        // si on veut voir les cartes m??res
        if ($categorie->getId() == '4') {
            // si le boitier est deja dans le panier
            $boitierChoisi = $panier->getBoitier();
            if ($boitierChoisi) {
                if ($boitierChoisi->getFormat() === 'Micro-ATX') {
                    $composants = $composants
                        ->andWhere("p.format = 'Micro-ATX'");
                }
                if ($boitierChoisi->getFormat() === 'Micro-ATX, ATX') {
                    $composants = $composants
                        ->andWhere("p.format = 'Micro-ATX'")
                        ->orWhere("p.format = 'ATX'");
                }
                if ($boitierChoisi->getFormat() === 'Micro-ATX, ATX, E-ATX') {
                    $composants = $composants
                        ->andWhere("p.format = 'Micro-ATX'")
                        ->orWhere("p.format = 'ATX'")
                        ->orWhere("p.format = 'E-ATX'");
                }
                $message = 'Les cartes m??res affich??es sont filtr??es pour afficher seulement celles qui sont
                compatibles le boitier choisi dans votre configuration.
                Format : ' . $boitierChoisi->getFormat() . '. Pour revenir ?? la selection compl??te des cartes m??res,
                supprimez votre boitier dans votre configuration';
            }

            // si le processeur est deja dans le panier
            $processeurChoisi = $panier->getProcesseur();
            if ($processeurChoisi) {
                $message2 = 'Les cartes m??res affich??es sont filtr??es pour afficher seulement celles qui sont
                compatibles avec votre processeur. Socket : ' . $processeurChoisi->getSocket();
                $composants = $composants
                    ->andWhere('p.socket = :socket')
                    ->setParameter('socket', $processeurChoisi->getSocket());
            }
        }

        return [$composants->orderBy('p.price', 'asc'), $message, $message2];
    }
}
