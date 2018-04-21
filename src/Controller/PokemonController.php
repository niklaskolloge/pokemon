<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\httpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends Controller
{
    /**
     * @Route(path="/ersteseite", name="pokemonerste_index")
     * @return Response
     */
    public function indexAction(): Response
    {
        $name = 'auf der ersten Seite';
        return $this->render('pages/index.html.twig', ['name' => $name]);
    }

    /**
     * @Route(path="/zweiteseite", name="pokemonzweite_index")
     * @return Response
     */
    public function indexTwoAction(): Response
    {
        $name = 'auf der zweiten Seite';
        return $this->render('pages/index.html.twig', ['name' => $name]);
    }
}