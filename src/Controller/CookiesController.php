<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}