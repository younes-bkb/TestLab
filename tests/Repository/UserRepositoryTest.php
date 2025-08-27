<?php

namespace App\Tests\Repository;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    public function testCount()
    {
        // Démarre le noyau de Symfony pour l'environnement de test
        self::bootKernel();

        // Récupère le conteneur de services via la méthode self::getContainer()
        $container = self::getContainer();

        // Récupère le UserRepository depuis le conteneur
        $userRepository = $container->get(UserRepository::class);

        // Effectue le test
        $usersCount = $userRepository->count([]);
        $this->assertEquals(10, $usersCount);
    }
}