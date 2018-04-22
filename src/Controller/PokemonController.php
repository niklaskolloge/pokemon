<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Services\PokemonService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends Controller
{
    /**
     * @Route(path="/", name="pokemonoverview")
     * @return Response
     */
    public function indexAction(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Pokemon::class);
        $pokemons = $repository->findAll();
        return $this->render('pages/index.html.twig', ['pokemons' => $pokemons]);
    }

    /**
     * @Route(path="/details/{id}", name="pokemondetails")
     * @return Response
     */
    public function details_action(int $id, PokemonService $pokemonService): Response
    {
        $pokemon = $pokemonService->getPokemonById($id);
        return $this->render('pages/details.html.twig', ['pokemon' => $pokemon]);
    }

}