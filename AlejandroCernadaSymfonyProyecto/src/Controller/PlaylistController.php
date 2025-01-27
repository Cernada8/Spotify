<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Playlist;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistController extends AbstractController
{
    #[Route('/playlist', name: 'app_playlist')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PlaylistController.php',
        ]);
    }

    #[Route('/playlist/new', name: 'newPlaylist')]
    public function crearEstilo(EntityManagerInterface $e){
        $usuarioRep=$e->getRepository(Usuario::class);
        $usuario=$usuarioRep->findOneByNombre('Gustavo');

        $playlist=new Playlist();
        $playlist->setVisibilidad('publica');
        $playlist->setNombre('P1');
        $playlist->setPropietario($usuario);
        $playlist->setReproducciones(123);
        $playlist->setLikes(123);
        $e->persist($playlist);
        $e->flush();

        return $this->json([
            'message' => 'playlist creada!',
            'path' => 'src/Controller/EstiloController.php',
        ]);
    }
}
