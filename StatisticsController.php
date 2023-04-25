<?php
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class StatisticsController extends AbstractController
{
    /**
     * @Route("/statistics", name="app_statistics")
     */
    public function index(UserRepository $userRepository): Response
    {
        $numberOfU = $userRepository->countU();
        $numberOfL = $userRepository->countL();
      
        $chartU = new PieChart();
        $chartU->getData()->setArrayToDataTable(
            [['Task', 'Hours per Day'],
                ['Utilisateur',((int) $numberOfU)],
                ['Livreur',((int) $numberOfL)],
            ]
        );
        $chartU->getOptions()->setTitle("Differents utilisateurs");
        $chartU->getOptions()->setHeight(400);
        $chartU->getOptions()->setIs3D(2);
        $chartU->getOptions()->setWidth(550);
        $chartU->getOptions()->getTitleTextStyle()->setBold(true);
        $chartU->getOptions()->getTitleTextStyle()->setColor('#009900');
        $chartU->getOptions()->getTitleTextStyle()->setItalic(true);
        $chartU->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $chartU->getOptions()->getTitleTextStyle()->setFontSize(15);

        return $this->render('statistics/index.html.twig', array(
            'chartU' => $chartU ,
          ));

       
    }
}
