<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Composant;
use App\Repository\PanierRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Composant>
 *
 * @method Composant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Composant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Composant[]    findAll()
 * @method Composant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComposantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PanierRepository $panierRepo, private Security $security)
    {
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
        // retrouve les composants en fonction de la categorie choisie
        $composants = $this->createQueryBuilder('p')
        ->andWhere('p.categorie = :categorie')
        ->setParameter('categorie', $categorie);

        // trouve le panier de l'utlisateur
        $currentUser = $this->security->getUser();
        if ($currentUser == null) {
            $panier = $this->panierRepo->Find(1);
        } else {
            $panier = $this->panierRepo->findOneBy(['user' => $this->security->getUser()]);
        }
            // si on veut voir les boitiers
            if ($categorie->getId() == "1") {
                // si la carte mere est deja dans le panier
                $carteMereChoisie = $panier->getCarteMere();
                if ($carteMereChoisie) {
                $composants = $composants
                    ->andWhere('p.format LIKE :format')
                    ->setParameter('format', '%'.$carteMereChoisie->getFormat().'%');
                }
            }

            // si on veut voir les processeurs
            if ($categorie->getId() == "3") {
                // si la carte mere est deja dans le panier
                $carteMereChoisie = $panier->getCarteMere();
                if ($carteMereChoisie) {
                $composants = $composants
                    ->andWhere('p.socket = :socket')
                    ->setParameter('socket', $carteMereChoisie->getSocket());

                }
            }
            // si on veut voir les cartes mères
            if ($categorie->getId() == "4") {
                // si le boitier est deja dans le panier
                $boitierChoisi = $panier->getBoitier();
                if ($boitierChoisi) {
                $composants = $composants
                    ->andWhere("p.format LIKE :format")
                    ->setParameter('format', '%' . $boitierChoisi->getFormat() . '%');
                }
                // si le processeur est deja dans le panier
                $processeurChoisi = $panier->getProcesseur();
                if ($processeurChoisi) {
                $composants = $composants
                    ->andWhere('p.socket = :socket')
                    ->setParameter('socket', $processeurChoisi->getSocket());
                }
            }

        return $composants->orderBy('p.price', 'asc');
    }
}




