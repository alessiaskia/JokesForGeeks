<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Gadget;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function homePage(): Response
    {
        //aller chercher dans le repo

        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Gadget::class);

        //renvoyer un array de gadgets
        $gadgets = $rep->findAll();
        $vars = ['gadgets' => $gadgets];

        return $this->render('home/home.html.twig', $vars);
    }
}
