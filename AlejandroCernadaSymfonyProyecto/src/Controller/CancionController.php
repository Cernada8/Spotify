<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Cancion;
use App\Entity\Estilo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class CancionController extends AbstractController
{
    #[Route('/cancion', name: 'app_cancion')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CancionController.php',
        ]);
    }

    #[Route('/cancion/new', name: 'newCancion')]
    public function crearEstilo(EntityManagerInterface $e){
        $estiloRep=$e->getRepository(Estilo::class);
        $estilo=$estiloRep->findOneByNombre('Musica clasica');

        $cancion=new Cancion();
        $cancion->setTitulo('Quedate');
        $cancion->setDuracion(123);
        $cancion->setAlbum('Donde quiero estar');
        $cancion->setAutor('Quevedo');
        $cancion->setGenero($estilo);
        $cancion->setReproducciones(1233);
        $cancion->setLikes(21);
        $e->persist($cancion);
        $e->flush();

        return $this->json([
            'message' => 'Cancion creada!',
            'path' => 'src/Controller/EstiloController.php',
        ]);
    }
}
