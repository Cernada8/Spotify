<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Estilo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class EstiloController extends AbstractController
{
    #[Route('/estilo', name: 'app_estilo')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/EstiloController.php',
        ]);
    }

    #[Route('/estilo/new', name: 'newEstilo')]
    public function crearEstilo(EntityManagerInterface $e){
        $estilo=new Estilo();
        $estilo->setNombre('Musica clasica');
        $estilo->setDescripcion('Musica antigua realilzada por artistas históricos.');
        $e->persist($estilo);
        $e->flush();

        return $this->json([
            'message' => 'Estilo creado!',
            'path' => 'src/Controller/EstiloController.php',
        ]);
    }

}
