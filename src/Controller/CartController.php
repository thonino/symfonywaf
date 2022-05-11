<?php

namespace App\Controller;


use DateTime;
use App\Entity\Users;
use App\Entity\Lesson;
use App\Entity\Booking;
use App\Repository\LessonRepository;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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
    public function show(
        Request $request,EntityManagerInterface $em,SessionInterface $session, 
        LessonRepository $lessonRepo,BookingRepository $bookingRepository,
        ): Response
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
            
            for ($i = 1; $i <= $quantite; $i++ ){
                if ($request->request->count()>0){

                    $userRepo = $em->getRepository(Users::class);
                    $user = $userRepo->find(1);
                    $firstname = $user->getFirstname();
                    $lastname = $user->getLastname();
                    // dd($firstname );
                    $booking[$i.$id] = new Booking();
                    $booking[$i.$id]->setStart(new DateTime($request->request->get('start'.$i.$id)))
                            ->setTitle($request->request->get('title'.$i.$id))
                            ->setFirstname($firstname)
                            ->setLastname($lastname);
                    $em->persist($booking[$i.$id]);
                    
                    $em->flush();
                }
            }
        }if($request->request->count()>0){return $this->redirectToRoute("app_invoice_new"); }
        ;
        return $this->render('cart/cart.html.twig', [
            'cartLessons'=>$fullCart,
            'total' =>$total,
            'bookings' => $bookingRepository->findAll(),

        ]);
    }
    #[Route(['/betaTest'], name: 'cart_betaTest')]
    public function create(Request $request,EntityManagerInterface $em){
        // Méthod 1
        // if ($request->request->count()>0){
        //     $booking = new Booking();
        //             $booking->setStart(new DateTime($request->request->get('start')))
        //                     ->setTitle($request->request->get('title'));
        //             $em->persist($booking);
        //             $em->flush();
        // }
        // return $this->render('cart/test.html.twig');
        
        // Méthod 2
        $booking = new Booking();
        $form = $this->createFormBuilder($booking)
        ->add('title', TextType::class,['attr' => ['class' => 'form-control'], 'label' => 'Prénom'])
        ->add('start', DateTimeType::class,['date_widget'=>'single_text', 'label' => 'Jour & Heure'],)
        ->add('submit', SubmitType::class,[ 'label' => 'Envoyer'],)
        ->getForm();
        $form->handleRequest($request);  // récupère les données de $request
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($booking);
            $em->flush();
            // dd($booking);
        }
        return $this->render('cart/test.html.twig',[
            'formTest'=>$form->createView(),
        ]);
    }
}
