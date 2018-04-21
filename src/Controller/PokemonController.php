<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\httpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends Controller
{
    /**
     * @Route(path="/", name="pokemon_index")
     * @return Response
     */

    public function indexAction(): Response
    {
        $name = 'Niklas';
        return $this->render( 'pages/index.html.twig', ['name' => $name]);
    }
}