<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomizationController extends AbstractController
{
    #[Route('/customization', name: 'customization')]
    public function customizationPage(): Response
    {
        //show joke selected in previous page
        // $em = $this->getDoctrine()->getManager();
        // $rep = $em->getRepository(Joke::class);
        // $selectedJoke = $rep->findOneBy(['id' => $idJoke]);


        return $this->render('customization/customization.html.twig');
    }
}
