<?php

namespace App\Controller;

use App\Entity\Bookings;
use App\Form\BookingsType;
use App\Repository\BookingsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingsController extends AbstractController
{
    
    /**
     * @Route("/bookings", name="bookings")
     */
    public function index(BookingsRepository $repo, Request $request, EntityManagerInterface  $manager)
    {
            $book = new Bookings();
        
            $bookings = $repo->findDatebooking();
         

            $form = $this->createForm(BookingsType::class, $book);
            $form->handleRequest($request);

        
            //$date = strtotime($_GET['date']);
           // $datebook = date('d/m/Y',$date);
           // $datee = $_GET['date'];
            if($form->isSubmitted() && $form->isValid()){
                
                $manager->persist($book);
                $manager->flush();

        
                $this->addFlash(
                    'success',
                    "L'annonce <strong>{$book->getName()}</strong> a bien été ajouté !"
                );
                return $this->redirectToRoute('home');
            }
           
           
                

        $duration = 10;
        $cleanup = 0;
        $start = "09:00";
        $end = "15:00";
        return $this->render('bookings/index.html.twig', [
            'duration' => $duration,
            'cleanup' => $cleanup,
            'start' => $start,
            'end' => $end,
            'bookings' => $bookings,
           // 'datebook' => $datebook,
           // 'datee' => $datee,
            'form' => $form->createView()
        ]);
    }
}
