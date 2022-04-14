<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResetToDoController extends AbstractController
{
    #[Route('/reset/to/do', name: 'app_reset_to_do')]
    public function index(SessionInterface $session): Response
    {
        $todos = array(
            'achat'=>'acheter clé usb',
            'cours'=>'Finaliser mon cours',
            'correction'=>'corriger mes examens'
        );
        $session->set("todos",$todos);
        $this->addFlash('notice',"Todo reset avec succes");
        return $this->render('to_do/index.html.twig');
    }
}
