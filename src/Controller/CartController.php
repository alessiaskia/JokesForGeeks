<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    //add SessionInterface in constructor for every controller
    //so it can be available in every action that might need it
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    #[Route('/cart', name: 'cart')]
    public function cartPage(): Response
    {

        return $this->render('cart/cart.html.twig');
    }
}
