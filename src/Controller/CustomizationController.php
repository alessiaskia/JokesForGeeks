<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Joke;
use App\Entity\Gadget;

class CustomizationController extends AbstractController
{
    #[Route('/customization/{chosenGadget}/{idJoke}', name: 'customization')]
    public function customizationPage(Request $req): Response
    {
        //obtain objects again from DB
        $chosenGadget = $req->request->get('chosenGadget');
        $idJoke = $req->request->get('jokeId');
        //dd($idJoke);

        //obtain remaining propreties of the selected jokes
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Joke::class);
        $chosenJoke = $rep->findOneBy(['id' => $idJoke]);
        //dd($chosenJoke);

        $vars = [
            'gadget' => $chosenGadget,
            'idJoke' => $idJoke,
            'chosenJoke' => $chosenJoke,
        ];

        return $this->render('customization/customization.html.twig', $vars);
    }
}
