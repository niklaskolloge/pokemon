<?php
namespace App\Services;
use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
class PokemonService
{
    /**
     *
     */
    const API_BASE_URL = 'http://pokeapi.co/api/v2/pokemon/{id}';
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * PokemonService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @param int $id
     * @return Pokemon|null
     */
    public function getPokemonById(int $id): ?Pokemon
    {
        $pokemon = $this->entityManager->getRepository(Pokemon::class)->find($id);
        if($pokemon !== null){
            return $pokemon;
        }
        try {
            $apiResponse = $this->callPokemonApi($id);
            return $this->transformApiResponse($apiResponse);
        } catch(\Exception $e){
            return null;
        }
    }
    /**
     * @param int $id
     * @return array
     */
    private function callPokemonApi(int $id): array
    {
        $url = str_replace('{id}', $id, self::API_BASE_URL);
        return json_decode(file_get_contents($url), true);
    }
    /**
     * @param array $apiResponse
     * @return Pokemon
     */
    private function transformApiResponse(array $apiResponse): Pokemon
    {
        $pokemon = new Pokemon();
        $pokemon->setId($apiResponse['id']);
        $pokemon->setName($apiResponse['name']);
        $pokemon->setHeight($apiResponse['height']);
        $pokemon->setWeight($apiResponse['weight']);
        $pokemon->setImage($apiResponse['sprites']['front_default']);
        $this->entityManager->persist($pokemon);
        $this->entityManager->flush();
        return $pokemon;
    }
    /**
     * @return array|Pokemon[]
     */
    public function getAll(): array
    {
        return $this->entityManager->getRepository(Pokemon::class)->findAll();
    }
}