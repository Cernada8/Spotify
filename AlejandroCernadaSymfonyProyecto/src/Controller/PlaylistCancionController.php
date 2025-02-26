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
    public function crearEstilo(EntityManagerInterface $e)
    {
        $cancionRep = $e->getRepository(Cancion::class);
        $cancion = $cancionRep->findOneByTitulo('Quedate');

        $playlistRep = $e->getRepository(Playlist::class);
        $playlist = $playlistRep->findOneByNombre('P1');

        $playlistCancion = new PlaylistCancion();
        $playlistCancion->setCancion($cancion);
        $playlistCancion->setPlaylist($playlist);
        $e->persist($playlistCancion);
        $e->flush();

        return $this->json([
            'message' => 'PlaylistCancion creada!',
            'path' => 'src/Controller/EstiloController.php',
        ]);
    }

    #[Route('/getCanciones/{nombre}', name: 'mostrar_todas_canciones_de_playlist')]
    public function mostrarCancionesDePlaylist(EntityManagerInterface $e, $nombre)
    {
        $playlistCRep = $e->getRepository(PlaylistCancion::class);
        $playlistRep = $e->getRepository(Playlist::class);
        $playlist = $playlistRep->findOneByNombre($nombre);

        $cancionesDePlaylist = $playlistCRep->findAllCancionesByPlaylist($playlist);

        $data = [];
        foreach ($cancionesDePlaylist as $cancion) {
            $data[] = [
                'titulo' => $cancion->getCancion()->getTitulo(),
                'autor' => $cancion->getCancion()->getAutor(),
                'id' => $cancion->getCancion()->getId(),
                'foto' => $cancion->getCancion()->getFoto(),
                'id' => $cancion->getCancion()->getId(),

            ];
        }

        return $this->json($data);
    }

    #[Route('/getCancionesYPlaylists', name: 'canciones_playlists')]
    public function cancionesYPlaylists(EntityManagerInterface $e)
    {
        $CancionPlayRep = $e->getRepository(PlaylistCancion::class);
        $data = $CancionPlayRep->getCancionesYPlaylist();
        $json = [];

        foreach ($data as $d) {
            $json[] = [
                'cancion' => [
                    'titulo' => $d->getCancion()->getTitulo(),
                    'autor' => $d->getCancion()->getAutor(),
                    'id' => $d->getCancion()->getId(),
                    'foto' => $d->getCancion()->getFoto(),
                    'id' => $d->getCancion()->getId(),
                ],
                'playlist'=>[
                    'nombre' => $d->getPlaylist()->getNombre(),
                    'propietario' => $d->getPlaylist()->getPropietario(),
                    'id' => $d->getPlaylist()->getId(),
                ]
            ];
        }

        return $this->json($json);
    }
}
