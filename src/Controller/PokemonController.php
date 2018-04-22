<?php

namespace App\Controller;

use App\Entity\Pokemon;
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
     * @Route(path="/pokemoncrawler", name="pokemonzweite_index")
     * @return Response
     */
    public function indexTwoAction(EntityManagerInterface $entityManager): Response
    {

        for ($id = 209; $id < 803; $id++) {
            try {
                $apiResponse = json_decode(file_get_contents("http://pokeapi.co/api/v2/pokemon/$id"), true);

                $pokemon = new Pokemon();
                $pokemon->setId($apiResponse['id']);
                $pokemon->setName($apiResponse['name']);
                $pokemon->setImage($apiResponse['sprites']['front_default']);
                $pokemon->setWeight($apiResponse['weight']);
                $pokemon->setHeight($apiResponse['height']);

                $entityManager->persist($pokemon);
                $entityManager->flush();
            } catch (\Exception $e) {
                return new Response("No Pokemon found for this ID");
            }
        }
        return Response("done");
    }

    /**
     * @Route(path="/details/{id}", name="pokemondetails")
     * @return Response
     */
    public function details_action(int $id, EntityManagerInterface $entityManager): Response
    {
        $pokemon = $entityManager->getRepository(Pokemon::class)->find($id);

        if ($pokemon === null) {
            try {
                $apiResponse = json_decode(file_get_contents("http://pokeapi.co/api/v2/pokemon/$id"), true);

                $pokemon = new Pokemon();
                $pokemon->setId($apiResponse['id']);
                $pokemon->setName($apiResponse['name']);
                $pokemon->setImage($apiResponse['sprites']['front_default']);
                $pokemon->setWeight($apiResponse['weight']);
                $pokemon->setHeight($apiResponse['height']);

                $entityManager->persist($pokemon);
                $entityManager->flush();
            } catch (\Exception $e) {
                return new Response("No Pokemon found for this ID");
            }
        }

        return $this->render('pages/details.html.twig', ['pokemon' => $pokemon]);
    }

}