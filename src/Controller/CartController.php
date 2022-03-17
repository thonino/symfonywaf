<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Repository\LessonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route([
    'en' => '/cart',
    'fr' => '/panier',
])]
class CartController extends AbstractController
{
    #[Route([
        'en' => '/{lesson}/add',
        'fr' => '/{lesson}/ajouter',
    ], name: 'cart_add')]
    public function add(Lesson $lesson, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $id = $lesson->getId();
        if (array_key_exists($id, $cart)){  $cart[$id]++;}
        else {  $cart[$id] =1; }
        $session->set('cart', $cart);
        return $this->redirectToRoute('app_lesson_index', [ 'id'=>$id,]);
    }
    #[Route([
        'en' => '/show',
        'fr' => '/voir',
    ], name: 'cart_show')]
    public function show(SessionInterface $session, LessonRepository $lessonRepo): Response
    {
        $fullCart = [];
        $total = 0;
        $cart = $session->get('cart', []);
        foreach($cart as $id =>$qty){
            $lesson = $lessonRepo->find($id);  
            $fullCart[]= ['lesson' => $lesson,'qty' => $qty,];
            $total += $lesson->getPrice()*$qty;
        }
        return $this->render('cart/show.html.twig', [
            'cartLessons'=>$fullCart,
            'total' =>$total,
        ]);
    }
}
