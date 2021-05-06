<?php

namespace App\Controller;

use App\Entity\Joke;
use App\Entity\Gadget;
use App\Entity\OrderDetail;
use App\Form\OrderDetailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CustomizationController extends AbstractController
{

    //add SessionInterface in constructor for every controller
    //so it can be available in every action that might need it
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

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

        //obtain remaining properties of the selected gadget
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Gadget::class);
        $chosenGadget = $rep->findOneBy(['type' => $chosenGadget]);

        //create a new OrderDetail (size + color + idjoke + idgadget)
        $orderDetail = new OrderDetail();

        //give it already the known properties
        $orderDetail->setJoke($chosenJoke);
        $orderDetail->setGadget($chosenGadget);
        $orderDetail->setQuantity(1);

        //create form, give method + action
        $form = $this->createForm(OrderDetailType::class, $orderDetail, [
            'action' => "{{ path('customization') }}",
            'method' => 'POST'
        ]);

        //handleRequest
        $form->handleRequest($req);
        //dd($orderDetail);

        //verify
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($orderDetail);
            $em->flush();
        }

        $vars = [
            // 'chosenGadget' => $chosenGadget,
            // 'idJoke' => $idJoke,
            // 'chosenJoke' => $chosenJoke,
            'form' => $form->createView(),
            'orderDetail' => $orderDetail, //everything is contained in orderDetail, no need to pass every variable separately
        ];


        return $this->render('customization/customization.html.twig', $vars);
    }
}
