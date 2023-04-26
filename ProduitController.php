<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    
    #[Route('/home', name: 'app_home_index', methods: ['GET'])]
    public function home(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/home.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitRepository $produitRepository): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();
            $imageFile = $form->get('image')->getData();
            
            // génération d'un nom de fichier unique
            $newFilename = uniqid().'.'.$imageFile->guessExtension();

            // déplacement du fichier dans le dossier public/images
            $imageFile->move(
                $this->getParameter('images_directory'),
                $newFilename
            );

            // mise à jour de l'attribut "image" de l'objet véhicule
            $produit->setImage($newFilename);
            $produitRepository->save($produit, true);

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{idProduit}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{idProduit}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        $produit=new Produit;
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();
            $imageFile = $form->get('image')->getData();
            
            // génération d'un nom de fichier unique
            $newFilename = uniqid().'.'.$imageFile->guessExtension();

            // déplacement du fichier dans le dossier public/images
            $imageFile->move(
                $this->getParameter('images_directory'),
                $newFilename
            );

            // mise à jour de l'attribut "image" de l'objet
            $produit->setImage($newFilename);
            $produitRepository->save($produit, true);

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{idProduit}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getIdProduit(), $request->request->get('_token'))) {
            $produitRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/search', name: 'app_produit_search', methods: ['GET'])]

    public function search(Request $request, EntityManagerInterface $entityManager): Response
    {
        $searchTerm = $request->query->get('p');
    
        $reclamations = $entityManager
            ->getRepository(Produit::class)
            ->createQueryBuilder('p')
            ->where('p.typeproduit LIKE :searchTerm OR p.prixproduit LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->getQuery()
            ->getResult();
    
        return $this->render('reclamation/search.html.twig', [
            'produits' => $produits,
            'searchTerm' => $searchTerm,
        ]);
    }

/*
    public function search(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Produit::class);
        $queryBuilder = $repository->createQueryBuilder('p');

        // Récupérer les paramètres de requête pour les filtres
        $filtreNom = $request->query->get('nom');
        $filtreCategorie = $request->query->get('categorie');
        $filtrePrixMin = $request->query->get('prix_min');
        $filtrePrixMax = $request->query->get('prix_max');

        // Appliquer les filtres à la requête
        if ($filtreNom) {
            $queryBuilder->andWhere('p.nom LIKE :nom')
                ->setParameter('nom', '%'.$filtreNom.'%');
        }

        if ($filtreCategorie) {
            $queryBuilder->andWhere('p.categorie = :categorie')
                ->setParameter('categorie', $filtreCategorie);
        }

        if ($filtrePrixMin) {
            $queryBuilder->andWhere('p.prix >= :prix_min')
                ->setParameter('prix_min', $filtrePrixMin);
        }

        if ($filtrePrixMax) {
            $queryBuilder->andWhere('p.prix <= :prix_max')
                ->setParameter('prix_max', $filtrePrixMax);
        }

        $produits = $queryBuilder->getQuery()->getResult();

        // Retourner la liste des produits filtrés
        return $this->render('produit/search.html.twig', [
            'produits' => $produits,
            'filtres' => [
                'nom' => $filtreNom,
                'categorie' => $filtreCategorie,
                'prix_min' => $filtrePrixMin,
                'prix_max' => $filtrePrixMax
            ]
        ]);
    }*/
}
