<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Form\LivraisonType;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\LivraisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/livraison')]
class LivraisonController extends AbstractController
{
    #[Route('/', name: 'app_livraison_index', methods: ['GET'])]
    public function index(LivraisonRepository $livraisonRepository , Request $request, PaginatorInterface $paginator): Response
    {

       
        $sortBy = $request->query->get('sortBy', 'idLivraison');
    $q = $request->query->get('q');

    if ($q) {
        $livraisons = $livraisonRepository->findByAdresseLivraison($q
    );
    } else {
        $livraisons = $livraisonRepository->findBy([], [$sortBy => 'ASC']);
    }

    // Utiliser le Paginator pour paginer les résultats
    $pagination = $paginator->paginate(
        $livraisons,
        $request->query->getInt('page', 1),
        10
    );

    return $this->render('livraison/index.html.twig', [
        'pagination' => $pagination,
        'livraisons' => $livraisons,
    ]);
    }



    #[Route('/new', name: 'app_livraison_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LivraisonRepository $livraisonRepository): Response
    {
        $livraison = new Livraison();
    $form = $this->createForm(LivraisonType::class, $livraison);
    $form->handleRequest($request);
    

    if ($form->isSubmitted() && $form->isValid()) {
        // Vérification de la date de livraison
        $today = new \DateTime();
        $dateLivraison = $livraison->getDateLivraison();
        
        if ($dateLivraison <= $today) {
            $livraison->setEtatLivraison('livré');
        } else {
            $livraison->setEtatLivraison('en cours');
        }
        
        $livraisonRepository->save($livraison, true);

        return $this->redirectToRoute('app_livraison_index', [], Response::HTTP_SEE_OTHER);
    }
    return $this->renderForm('livraison/new.html.twig', [
        'livraison' => $livraison,
        'form' => $form,
    ]);
   }
   



   

    #[Route('/{idLivraison}', name: 'app_livraison_show', methods: ['GET'])]
    public function show(Livraison $livraison,Request $request, PaginatorInterface $paginator): Response
    {
        // Utiliser le Paginator pour paginer les résultats
    $pagination = $paginator->paginate(
        $livraison,
        $request->query->getInt('page', 1),
        10
    );
        return $this->render('livraison/show.html.twig', [
            'livraison' => $livraison,
        ]);
    }

    #[Route('/{idLivraison}/edit', name: 'app_livraison_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Livraison $livraison, LivraisonRepository $livraisonRepository): Response
    {
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $livraisonRepository->save($livraison, true);

            return $this->redirectToRoute('app_livraison_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('livraison/edit.html.twig', [
            'livraison' => $livraison,
            'form' => $form,
        ]);
    }

    #[Route('/{idLivraison}', name: 'app_livraison_delete', methods: ['POST'])]
    public function delete(Request $request, Livraison $livraison, LivraisonRepository $livraisonRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livraison->getIdLivraison(), $request->request->get('_token'))) {
            $livraisonRepository->remove($livraison, true);
        }

        return $this->redirectToRoute('app_livraison_index', [], Response::HTTP_SEE_OTHER);
    }



     #[Route('/livred/{id}', name: 'livred', methods: ['GET'])]
public function LivredLivraison(Livraison $liv, EntityManagerInterface $entityManager): Response
{
    $today = new \DateTime();
    $dateLivraison = $liv->getDateLivraison();
    
    if ($dateLivraison <= $today) {
        $liv->setEtatLivraison(string::LIVRED);
        $entityManager->getRepository(Livraison::class)->save($liv, true);

        return $this->redirectToRoute('app_livraison_index');
    } else {
        // La date de livraison n'est pas encore passée
        // Vous pouvez ajouter un message flash pour informer l'utilisateur
        $this->addFlash('warning', 'La date de livraison n\'est pas encore passée.');
        return $this->redirectToRoute('app_livraison_index');
    }
}

}
