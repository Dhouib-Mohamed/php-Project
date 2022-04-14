<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AjouterToDoController extends AbstractController
{
    #[Route('/ajouter/to/do/{title}/{content}', name: 'app_ajouter_to_do')]
    public function index(SessionInterface $session,$title,$content): Response
    {
        $todos = $session->get("todos");
        if(!isset($todos[$title])) {
            $todos[$title] = $content;
            $session->set("todos",$todos);
            $this->addFlash('notice',"Nouveau Todo ajouté avec succées");
            $message = "Nouveau Todo ajouté avec succées";
        }
        else {
            $this->addFlash('error',"Nouveau Todo avec le meme titre existe");
            $message = "Nouveau Todo avec le meme titre existe";
        }
        return $this->render('to_do/index.html.twig', [
            'message_flash' => $message,
        ]);
    }
}
