<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class CookiesController extends AbstractController
{
    public function cookies(): Response
    {
        if (isset($_POST['ok'])){ 
                setcookie('ok','fr', time() + 3600*24*365,null,null,false,true);
                $delay = 0.1;
                header("Refresh: $delay;");
            }
        return $this->render('cookies/cookies.html.twig');
    }  
    
#[Route('/mentionsLegales', name: 'app_mentions_legales')]
    public function mentionsLegales()
    {
        return $this->render('cookies/mentionsLegales.html.twig');
    }  

#[Route('/confidentialite', name: 'app_confidential')]
    public function confidential()
    {
        return $this->render('cookies/confidential.html.twig');
    }  

#[Route('/cgv', name: 'app_cgv')]
    public function cgv()
    {
        return $this->render('cookies/cgv.html.twig');
    }  
}
