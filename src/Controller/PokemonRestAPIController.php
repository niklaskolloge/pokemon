<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

class PokemonRestAPIController extends Controller
{
    /**
     * @Route("/pokemon/api", name="pokemon_rest_a_p_i")
     */
    public function getAllPokemons(EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {

        $pokemon = $entityManager->getRepository(Pokemon::class)->findAll();
        $serializedObjects = $serializer->serialize($pokemon, 'json');

        return new Response($serializedObjects);
    }
}
