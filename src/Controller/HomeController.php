<?php

namespace App\Controller;

use App\Entity\Joke;
use App\Entity\Gadget;
use App\Entity\Order;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    //add SessionInterface in constructor for every controller
    //so it can be available in every action that might need it
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }


    #[Route('/home', name: 'home')]
    public function homePage(): Response
    {
        //obtain app.user dans la vue
        $this->getUser();

        //create cart in session
        $this->session->set('cart', new Order());

        //obtain cart containing an Order object
        $cart = $this->session->get('cart');

        //aller chercher dans le repo - jokes
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Joke::class);

        //renvoyer un array de jokes
        $jokes = $rep->findAll();
        $randomJoke = $jokes[array_rand($jokes)];

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
    public function getNextJoke()
    {
        //aller chercher dans le repo - jokes
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Joke::class);

        //renvoyer un array de jokes
        $jokes = $rep->findAll();
        $randomJoke = $jokes[array_rand($jokes)];

        return $this->json($randomJoke);
    }

    //this route is called in the second form in template "home"
    //purpose: get chosen gadget + id of choses joke and transfer all to Customization view
    #[Route('/home/custom/gadget', name: 'custom_gadget')]
    public function customGadget(Request $req)
    {
        $chosenGadget = $req->request->get('chosenGadget');
        //dump($chosenGadget);
        $idJoke = $req->request->get('jokeId');
        //dd($idJoke);

        // $vars = [
        //     'gadget' => $chosenGadget,
        //     'idJoke' => $idJoke,
        // ];

        //transfer variable to next controller with FORWARD
        $response = $this->forward('App\Controller\CustomizationController::customizationPage', [
            'chosenGadget' => $chosenGadget,
            'idJoke' => $idJoke,
        ]);

        return $response;
        // return $this->render('customization/customization.html.twig', $vars);
    }
}
