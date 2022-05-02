<?php

namespace App\Controller;


use DateTime;
use App\Entity\Lesson;
use App\Entity\Booking;
use App\Repository\LessonRepository;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cart')]
class CartController extends AbstractController
{
    // Fonction ADD
    #[Route(['/{lesson}/ajouter'], name: 'cart_add')]
    public function add(Lesson $lesson, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $id = $lesson->getId();
        if (array_key_exists($id, $cart)){  $cart[$id]++;}
        else {  $cart[$id] =1; }
        $session->set('cart', $cart);
        return $this->redirectToRoute('cart_show', [ 'id'=>$id,]);
    }
    // Fonction LESS
    #[Route(['/{lesson}/moins'], name: 'cart_less')]
    public function less(Lesson $lesson, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $id = $lesson->getId();
        if (2 > $cart[$id]){unset($cart[$id]);} 
        else { $cart[$id]--;}
        $session->set('cart', $cart);
        return $this->redirectToRoute('cart_show', [ 'id'=>$id,]);
    }
    // Fonction supprimer
    #[Route(['/{lesson}/suprimmer'], name: 'cart_del')]
    public function remove(Lesson $lesson, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $id = $lesson->getId();
        unset($cart[$id]);
        $session->set('cart', $cart);
        return $this->redirectToRoute('cart_show', [ 'id'=>$id,]);
    }
    #[Route(['/show'], name: 'cart_show')]
    public function show(EntityManagerInterface $em,SessionInterface $session, LessonRepository $lessonRepo,BookingRepository $bookingRepository): Response
    {
        $total = 0;
        $totalQty = 0;
        $fullCart = [];
        $cart = $session->get('cart', []);
        foreach($cart as $id =>$quantite){
            $lesson = $lessonRepo->find($id);  
            $price = $lesson->getPrice();
            $fullCart[]= ['lesson' => $lesson,'quantite' => $quantite,];
            $total += $price*$quantite;
            $totalQty += $quantite;
            for ($i = 1; $i < $totalQty; $i++ )
                if ($_POST){
                {
                    $booking[$i] = new Booking();
                    $booking[$i]->setStart(new DateTime($_POST['start'.$i]))->setTitle($_POST['title'.$i]);
                    $em->persist($booking);
                    $em->flush();
                    return $this->redirectToRoute('app_booking_index',);}
                }
            };
        
        return $this->render('cart/cart.html.twig', [
            'cartLessons'=>$fullCart,
            'total' =>$total,
            'bookings' => $bookingRepository->findAll(),
            'quantite'=> $quantite,
            
        ]);
    }
}
