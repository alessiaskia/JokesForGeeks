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

        //obtain remaining propreties of the selected gadget
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Gadget::class);
        $chosenGadget = $rep->findOneBy(['type' => $chosenGadget]);

        //create a new Option Gadget (size + color)
        $orderDetail = new OrderDetail();

        $orderDetail->setJoke($chosenJoke);
        $orderDetail->setGadget($chosenGadget);

        $form = $this->createForm(OrderDetailType::class, $orderDetail);
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
            'orderDetail' => $orderDetail, //everything is passed by orderDetail, no need to pass every variable separately
        ];


        return $this->render('customization/customization.html.twig', $vars);
    }
}
