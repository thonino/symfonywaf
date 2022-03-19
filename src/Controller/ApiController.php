<?php
namespace App\Controller;
use App\Entity\Booking;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
    /**
     * @Route("/api/{id}/edit", name="api_event_edit", methods={"PUT"})
     */
    public function majEvent(?Booking $booking, Request $request)
    {
        $donnees = json_decode($request->getContent());
        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) 
        ){
            $code = 200;
            if(!$booking){
                $booking = new Booking;
                $code = 201;
            }
            $booking->setTitle($donnees->title);
            $booking->setStart(new DateTime($donnees->start));
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();
            return new Response('Ok', $code);
        }else{
            return new Response('Données incomplètes', 404);
        }
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}