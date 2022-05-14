<?php

namespace App\Controller;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use App\Repository\LessonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(LessonRepository $lessonRepo): Response
    {
        return $this->render('home/index.html.twig', [
            'lessons' => $lessonRepo->findAll(),
        ]);
    }
    #[Route('/home/contact', name: 'app_home_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        if ($request->request->all()){
            $email = new Email();
            $email->to(new Address("thoninoben@gmail.com", "thonino"))
                    ->from($request->request->get("email"))
                    ->subject($request->request->get("email"))
                    ->text($request->request->get("message"));
            $mailer->send($email);
            $this->addFlash("success", "votre message a été envoyé");
            ;}
        
        return $this->render('home/contact.html.twig', [

        ]);
    }
}
