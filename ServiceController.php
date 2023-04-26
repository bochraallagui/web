<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Categorie;
use App\Service\BadWordsService;


#[Route('/service')]
class ServiceController extends AbstractController
{
    #[Route('/', name: 'app_service_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager , Request $request, PaginatorInterface $paginator, ?Categorie $categorie = null): Response
    {
        $queryBuilder = $entityManager->getRepository(Service::class)->createQueryBuilder('r');
         $pagination = $paginator->paginate(
             $queryBuilder,
             $request->query->getInt('page', 1), // Default page number
             3// Items per page
         );

        //  $em = $this->getDoctrine()->getManager();
        //  $categories = $em->getRepository(Categorie::class)->findAll();
        //  $qb = $em->createQueryBuilder();
     
        //  $qb->select('s')
        //      ->from(Service::class, 's')
        //      ->leftJoin('s.fkIdCategorie', 'c')
        //      ->orderBy('s.dateService', 'DESC');
     
        //  if ($categorie) {
        //      $qb->andWhere('c = :categorie')
        //          ->setParameter('categorie', $categorie);
        //  }
     
        //  $services = $qb->getQuery()->getResult();
     


        //  $search = $request->query->get('search');
     
        //  if ($search) {
        //      $queryBuilder->where('r.idUser = :search')
        //                   ->setParameter('search', $search);
        //  }
     
//  // get the search string from the form
//  $searchString = $request->query->get('search');

//  // filter by the type_categorie field if a search string is provided
//  if ($searchString) {
//      $queryBuilder
//          ->andWhere('r.typeCategorie LIKE :search')
//          ->setParameter('search', '%' . $searchString . '%')
//          ->getQuery()
//          ->execute();
//  }

         return $this->render('service/index.html.twig', [
            'services' => $pagination,
            //  'categories' => $categories,
            //  'categorie' => $categorie,
         ]);
        }
     


       


       




//Exporter pdf (composer require dompdf/dompdf)
#[Route('/pdf', name: 'app_pdf', methods: ['GET'])]
      public function pdf(EntityManagerInterface $entityManager)
      {
          // Configure Dompdf according to your needs
          $pdfOptions = new Options();
          $pdfOptions->set('defaultFont', 'Arial');
  
          // Instantiate Dompdf with our options
          $dompdf = new Dompdf($pdfOptions);
          // Retrieve the HTML generated in our twig file
          $html = $this->renderView('service/pdf.html.twig', [
              'services' => $services = $entityManager->getRepository(Service::class)->findAll(),
          ]);
  
          // Load HTML to Dompdf
          $dompdf->loadHtml($html);
          // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
          $dompdf->setPaper('A4', 'portrait');
  
          // Render the HTML as PDF
          $dompdf->render();
          // Output the generated PDF to Browser (inline view)
          $dompdf->stream("ListeDesServices.pdf", [
              "services" => true
          ]);
        }


      

    #[Route('/new', name: 'app_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager , BadWordsService $badWordsService): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentText = $service->getDescriptionService();
            $containsBadWords = $badWordsService->containsBadWords($commentText);
            if ($containsBadWords) {
                // If the comment contains bad words, show an error message
                $this->addFlash('error', 'Your description contains bad words!');
            } else {
            $entityManager->persist($service);
            $entityManager->flush();
            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }
           
        }

        return $this->renderForm('service/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{idService}', name: 'app_service_show', methods: ['GET'])]
    public function show(Service $service): Response
    {
        return $this->render('service/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{idService}/edit', name: 'app_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{idService}', name: 'app_service_delete', methods: ['POST'])]
    public function delete(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getIdService(), $request->request->get('_token'))) {
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
    }


    
}








