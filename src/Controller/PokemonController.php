<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\httpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends Controller
{
    /**
     * @Route(path="/ersteseite", name="pokemonerste_index")
     * @return Response
     */
    public function indexAction(EntityManagerInterface $entityManager): Response
    {
        $name = 'auf der ersten Seite';

        $pokemon = new Pokemon();
        $pokemon->setId(1);
        $pokemon->setName("Bisasam");
        $pokemon->setHeight(20);
        $pokemon->setWeight(30);
        $pokemon->setImage("bild");

        $entityManager->persist($pokemon);
        $entityManager->flush();

        return $this->render('pages/index.html.twig', ['name' => $name, 'pokemon'=> $pokemon]);
    }

    /**
     * @Route(path="/zweiteseite", name="pokemonzweite_index")
     * @return Response
     */
    public function indexTwoAction(EntityManagerInterface $entityManager): Response
    {

        $repository = $entityManager->getRepository(Pokemon::class);
        $pokemon = $repository->find(1);

        $name = 'auf der zweiten Seite';
        return $this->render('pages/index.html.twig', ['name' => $name, 'pokemon' => $pokemon]);
    }


}