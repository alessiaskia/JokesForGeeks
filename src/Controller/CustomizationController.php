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

        //give it already the known properties and set quantity = 1 as default value
        $orderDetail->setJoke($chosenJoke);
        $orderDetail->setGadget($chosenGadget);
        $orderDetail->setQuantity(1);

        //create form, give method + action
        $form = $this->createForm(OrderDetailType::class, $orderDetail, [
            'method' => 'POST'
        ]);

        //handleRequest = fills the OrderDetail
        $form->handleRequest($req);
        //dd($orderDetail);

        //obtain order from session
        $order = $this->session->get('cart');
        $order->setCountry('Peru');
        //dd($order);
        $order->addOrderDetail($orderDetail);
        //dd($order);

        //verify
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();
            //dd($order);
            $this->session->set('cart', $order);
            return $this->redirectToRoute('cart');
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
