<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Cancion;
use App\Entity\Estilo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
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

    #[Route('/cancion/mostrarTodas', name:'mostrar_todas_caniones')]
    public function mostrarCanciones(EntityManagerInterface $e)
    {
        $cancionRep = $e->getRepository(Cancion::class);
        $canciones = $cancionRep->findAll();

        $data=[];
        foreach($canciones as $cancion){
            $data[]=[
                'titulo'=>$cancion->getTitulo(),
                'id'=>$cancion->getId(),
                'autor'=>$cancion->getAutor(),
                'foto'=>$cancion->getFoto()
            ];
        }

        // Retorna la respuesta en JSON
        return $this->json($data);
    }

    #[Route('cancion/{id}', name:'ruta_cancion')]
    public function buscarCanciones(EntityManagerInterface $e, $id)
    {
        $cancionRep = $e->getRepository(Cancion::class);
        $cancion=$cancionRep->find($id);

        $ruta='music/'.$id.'.mp3';

        return new BinaryFileResponse($ruta);
    }

    #[Route('cancion/sumarLikes/{nombre}', name:'sumar_like')]
    public function sumarLike(EntityManagerInterface $e, $nombre)
    {
        $cancionRep = $e->getRepository(Cancion::class);
        $cancion=$cancionRep->findOneByTitulo($nombre);

        $cancion->setLikes($cancion->getLikes()+1);

        $e->persist($cancion);
        $e->flush();
        $data=[];
        $data[]=[
            'likes'=>0
        ];

        return $this->json($data);

        
    }

    #[Route('cancion/restarLikes/{nombre}', name:'restar_like')]
    public function restarLike(EntityManagerInterface $e, $nombre)
    {
        $cancionRep = $e->getRepository(Cancion::class);
        $cancion=$cancionRep->findOneByTitulo($nombre);

        $cancion->setLikes($cancion->getLikes()-1);
        
        $e->persist($cancion);
        $e->flush();
	$data=[];
        $data[]=[
            'likes'=>0
        ];

        return $this->json($data);
    }

    #[Route('getLikes/{nombre}', name:'get_like')]
    public function getLikes(EntityManagerInterface $e, $nombre)
    {
        $cancionRep = $e->getRepository(Cancion::class);
        $cancion=$cancionRep->findOneByTitulo($nombre);

        $likes= $cancion->getLikes();
        
        $data=[];
        $data[]=[
            'likes'=>$likes
        ];

        return $this->json($data);
    }

}
