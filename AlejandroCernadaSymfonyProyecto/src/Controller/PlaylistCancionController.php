<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Cancion;
use App\Entity\Playlist;
use App\Entity\PlaylistCancion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistCancionController extends AbstractController
{
    #[Route('/playlist/cancion', name: 'app_playlist_cancion')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PlaylistCancionController.php',
        ]);
    }

    #[Route('/playlistCancion/new', name: 'newCancion')]
    public function crearEstilo(EntityManagerInterface $e){
        $cancionRep=$e->getRepository(Cancion::class);
        $cancion=$cancionRep->findOneByTitulo('Quedate');

        $playlistRep=$e->getRepository(Playlist::class);
        $playlist=$playlistRep->findOneByNombre('P1');

        $playlistCancion=new PlaylistCancion();
        $playlistCancion->setCancion($cancion);
        $playlistCancion->setPlaylist($playlist);
        $e->persist($playlistCancion);
        $e->flush();

        return $this->json([
            'message' => 'PlaylistCancion creada!',
            'path' => 'src/Controller/EstiloController.php',
        ]);
    }
}
