<?php

namespace App\Controller;
use App\Repository\BookingRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class CalendarController extends AbstractController
{
    #[Route('/calendrier', name: 'app_calendar')]
    public function index(BookingRepository $calendar)
    {
        $events = $calendar->findAll();
        $rdv = [];
        foreach($events as $event){
            $rdv[] = [
                'id'=>$event->getId(),
                'firstname'=>$event->getFirstname(),
                'start'=>$event->getStart()->format('Y-m-d H:i:s'),
            ];
        }
        $data = json_encode($rdv);
        return $this->render('calendar/index.html.twig', compact('data'));
    }
}
