<?php

namespace App\Controller;

use App\Entity\Cancion;
use App\Entity\Estilo;
use App\Entity\Playlist;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class EstadisticasController extends AbstractController
{
    #[Route('/estadisticas', name: 'app_estadisticas')]
    public function index(LoggerInterface $log): Response
    {

        $log->debug('[' . date('Y-m-d H:i:s') . '] ' . 'El manager ha entrado a ver las estadisticas.');
        return $this->render('estadisticas/index.html.twig', [
            'controller_name' => 'EstadisticasController',
        ]);
    }

    #[Route('/manager/estadisticas/playlistLikes', name: 'playlist_likes')]
    public function playlistLikes(EntityManagerInterface $e)
    {
        $playlistRep = $e->getRepository(Playlist::class);
        $data = $playlistRep->mostrarPlaylistLikes();

        return $this->json($data);
    }

    #[Route('/manager/estadisticas/playlistReproducciones', name: 'playlist_reproducciones')]
    public function playlistReproducciones(EntityManagerInterface $e)
    {
        $playlistRep = $e->getRepository(Playlist::class);
        $data = $playlistRep->mostrarPlaylistReproducciones();

        return $this->json($data);
    }

    #[Route('/manager/estadisticas/usuarioEdad', name: 'usuario_edad')]
    public function usuarioEdad(EntityManagerInterface $e)
    {
        $usuarioRep = $e->getRepository(Usuario::class);
        $fechas = $usuarioRep->usuarioEdad();
        $data = [];
        $hoy = new \DateTime();

        $contadorEdades = [
            'Menores 18' => 0,
            'Entre 18-30' => 0,
            'Entre 31-50' => 0,
            'Mayores 50' => 0
        ];

        foreach ($fechas as $fecha) {
            $fechaNacimiento = $fecha['fechaNacimiento'];
            $edad = $fechaNacimiento->diff($hoy)->y;

            switch (true) {
                case ($edad < 18):
                    $contadorEdades['Menores 18']++;
                    break;
                case ($edad >= 18 && $edad <= 30):
                    $contadorEdades['Entre 18-30']++;
                    break;
                case ($edad >= 31 && $edad <= 50):
                    $contadorEdades['Entre 31-50']++;
                    break;
                case ($edad > 50):
                    $contadorEdades['Mayores 50']++;
                    break;
            }
        }

        foreach ($contadorEdades as $rango => $numero) {
            $data[] = [
                'rango' => $rango,
                'numero' => $numero
            ];
        }

        return $this->json($data);
    }

    #[Route('/manager/estadisticas/cancionesReproducciones', name: 'canciones_reproducciones')]
    public function cancionesReproducciones(EntityManagerInterface $e)
    {
        $cancionRep = $e->getRepository(Cancion::class);
        $data = $cancionRep->mostrarCancionesReproducciones();

        return $this->json($data);
    }

    #[Route('/manager/estadisticas/reproduccionesEstilo', name: 'reproducciones_estilo')]
    public function reproduccionesEstilo(EntityManagerInterface $e)
    {
        $estiloRep = $e->getRepository(Estilo::class);
        $data = $estiloRep->reproduccionesPorEstilo();

        return $this->json($data);
    }
}
