<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Playlist;
use App\Entity\UsuarioPlaylist;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class UsuarioPlaylistController extends AbstractController
{
    #[Route('/usuario/playlist', name: 'app_usuario_playlist')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsuarioPlaylistController.php',
        ]);
    }

    #[Route('/usuarioPlaylist/new', name: 'newUsuarioPlaylist')]
    public function crearEstilo(EntityManagerInterface $e){
        $usuarioRep=$e->getRepository(Usuario::class);
        $usuario=$usuarioRep->findOneByNombre('Gustavo');

        $playlistRep=$e->getRepository(Playlist::class);
        $playlist=$playlistRep->findOneByNombre('P1');

        $usuarioPlaylist=new UsuarioPlaylist();
        $usuarioPlaylist->setReproducida(123132424);
        $usuarioPlaylist->setUsuario($usuario);
        $usuarioPlaylist->setPlaylist($playlist);
        $e->persist($usuarioPlaylist);
        $e->flush();

        return $this->json([
            'message' => 'usuarioPlaylist creada!',
            'path' => 'src/Controller/EstiloController.php',
        ]);
    }
}
