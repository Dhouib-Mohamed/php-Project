<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SupprimerToDoController extends AbstractController
{
    #[Route('/supprimer/to/do/{title}', name: 'app_supprimer_to_do')]
    public function index(SessionInterface $session,$title): Response
    {
        $todos = $session->get("todos");
        if(isset($todos[$title])) {
            unset($todos[$title]);
            $session->set("todos",$todos);
            $this->addFlash('notice',"Todo supprimée avec succées");
            $message = "Todo supprimée avec succées";
        }
        else {
            $this->addFlash('error',"Todo avec ce titre n'existe pas");
            $message = "Todo avec ce titre n'existe pas";
        }
        return $this->render('to_do/index.html.twig', [
            'message_flash' => $message,
        ]);
    }
}
