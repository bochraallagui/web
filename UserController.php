<?php

namespace App\Controller;
use App\Repository\UserRepository;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;


#[Route('/user')]
class UserController extends AbstractController
{

    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            $email = (new Email())
        ->from('hajer.bakir@esprit.tn')
        ->To($form->get('email')->getData())
        ->subject('Welcome!')
         ->text("Vous avez un nouveau compte SWAP");
               
       
 try {
        $mailer->send($email);
    } catch (TransportExceptionInterface $e) {
        // Gérer les erreurs d'envoi de courriel
    }

           // return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auth/register.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/order_By_Nom', name: 'order_By_Nom', methods: ['GET'])]
    public function order_By_Nom(Request $request,UserRepository $UserRepository): Response
    {
        $users= $UserRepository->orderByNom();

        return $this->render('User/index.html.twig', [
            'users' => $users,
        ]);

    }
    ///////////////////////////////////////////////////////////////////
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager
            ->getRepository(User::class)
            ->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }


     ///////////////////////////////////////////

//      #[Route('/search', name: 'search')]
//      public function searchUser(Request $request, NormalizerInterface $Normalizer,UserRepository $sr)
//      {
//          $repository = $this->getDoctrine()->getRepository(User::class);
//          $requestString = $request->get('searchValue');
//          $Users = $repository->findUserByNom($requestString);
//          $jsonContent = $Normalizer->normalize($Users, 'json', ['groups' => 'users']);
//          $retour = json_encode($jsonContent);
//          return new Response($retour);
    
// }
////////////////////////////////////////

  

}
