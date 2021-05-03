<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Gadget;
use App\Entity\Joke;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\NotNull;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function homePage(): Response
    {

        //aller chercher dans le repo - jokes
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Joke::class);

        //renvoyer un array de jokes
        $jokes = $rep->findAll();
        $randomId = array_rand($jokes);
        //dd($randomId);
        $randomJoke = $rep->findOneBy(['id' => $randomId]);
        //dd($randomJoke);

        //aller chercher dans le repo - gadgets
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Gadget::class);

        //renvoyer un array de gadgets et 1 joke
        $gadgets = $rep->findAll();
        $vars = [
            'gadgets' => $gadgets,
            'randomJoke' => $randomJoke
        ];


        return $this->render('home/home.html.twig', $vars);
    }

    #[Route('/home/next/joke', name: 'next_joke')]
    public function getNextJoke(Request $ajaxRequest)
    {
        $idJoke = $ajaxRequest->get('id');
        $setup = $ajaxRequest->get('setup');
        $punchline = $ajaxRequest->get('punchline');

        $arrayResponse = [
            'idJoke' => $idJoke,
            'setup' => $setup,
            'punchline' => $punchline,
        ];

        return new JsonResponse($arrayResponse);
    }
}
