<?php

namespace App\Controller;
use App\Entity\Invoice;
use App\Entity\Purchase;
use App\Form\InvoiceType;
use App\Repository\LessonRepository;
use App\Repository\InvoiceRepository;
use App\Repository\PurchaseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InvoiceController extends AbstractController
{
    #[Route('/invoice/factures', name: 'app_invoices')]
    public function index(InvoiceRepository $invoice): Response
    {
        return $this->render('invoice/index.html.twig', [
            'invoices' => $invoice->findAll(),
        ]);
    }
    #[Route('/invoice/{id}', name: 'app_invoice_show', methods: ['GET'])]
    public function show(Invoice $invoice,PurchaseRepository $purchase,LessonRepository $lesson): Response
    {
        return $this->render('invoice/show.html.twig', [
            'invoice' => $invoice,
            'purchases' => $purchase->findAll(), 
            'lessons' => $lesson->findAll(), 
            
        ]);
    }
    #[Route('/facture/commande', name: 'app_invoice_new', methods: ['GET', 'POST'])]
    public function new(Request $request,SessionInterface $session,LessonRepository $lessonRepo): Response
    {
        $invoice = new Invoice();
        $user = $this->getUser();
        if ($user) {
            $invoice->setFirstname($user->getFirstname())
            ->setLastname($user->getLastname())
            ->setPhone($user->getPhone())
            ->setAddress($user->getAddress())
            ->setZipcode($user->getZipcode())
            ->setCity($user->getCity())
            ;
        }
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);
        $fullCart = [];
        $total = 0;
        $cart = $session->get('cart', []);
        foreach($cart as $id =>$qty){
            $lesson = $lessonRepo->find($id);  
            $fullCart[]= ['lesson' => $lesson,'qty' => $qty,];
            $total += $lesson->getPrice()*$qty;
            $qties[] = $qty;
            
                    
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $invoice->setTotalPrice($total)
                    ->setPaid(false)    
                    ->setStripeSuccessKey(uniqid());
            $entityManager->persist($invoice);

            foreach($cart as $id =>$qty){
                $lesson = $lessonRepo->find($id);
                $purchase = new Purchase;
                $purchase->setInvoice($invoice)
                ->setlesson($lesson)
                ->setUnitPrice($lesson->getPrice())
                ->setQuantity($qty);
                $entityManager->persist($purchase);
            }
            $entityManager->flush();
            return $this->redirectToRoute('stripe_checkout', ["invoice"=> $invoice->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('invoice/new.html.twig', [
            
            'invoice' => $invoice,
            'form' => $form,
            'cartLessons'=>$fullCart,
            'total' =>$total,
            'fa'=>$invoice->getId(),
        ]);
    }
}