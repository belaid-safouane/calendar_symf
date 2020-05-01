<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $tableau = [
            ['prenom' => 'Lior', 'nom' => 'Chamla', 'age' => 32],
            ['prenom' => 'Jean', 'nom' => 'Dupont', 'age' => 50],
            ['prenom' => 'Anne', 'nom' => 'Durand', 'age' => 30],
            ['prenom' => 'Sophie', 'nom' => 'Paillard', 'age' => 42],
        ];

        $dateComponents = getdate();
        if(isset($_GET['month']) && isset($_GET['year']))
        {
            $month = $_GET['month']; 			     
            $year = $_GET['year'];
        }else{
            $month = $dateComponents['mon']; 			     
            $year = $dateComponents['year'];
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'tableau' => $tableau,
            'month' => $month,
            'year' => $year
        ]);
    }
}
