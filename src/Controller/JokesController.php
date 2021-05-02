<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Filesystem\Filesystem;
use App\Entity\Joke;

class JokesController extends AbstractController
{
    #[Route('/save/jokes', name: 'save_jokes')]
    public function saveJokesFromJson(): Response
    {

        //get all jokes from the jokes.json file
        $fs = new Filesystem();

        // dd($jokesJson);

        //transform json -> array associatif
        $contenuJson = file_get_contents('official_joke_api.json');
        $arrayJokes = json_decode($contenuJson, true); // true -> returns array associatif
        //dd($arrayJokes);

        //get manager
        $em = $this->getDoctrine()->getManager();

        //obtain properties and create object
        foreach ($arrayJokes as $arrayJoke) {
            if ($arrayJoke['type'] == 'programming') {
                $joke = new Joke([
                    'setup' => $arrayJoke['setup'],
                    'punchline' => $arrayJoke['punchline'],
                ]);

                //link object to DB
                $em->persist($joke);

                //write object into DB
                $em->flush();
            }
        }



        return $this->render('jokes/jokes.html.twig');
    }
}
