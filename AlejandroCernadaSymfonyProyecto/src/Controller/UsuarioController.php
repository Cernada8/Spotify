<?php

namespace App\Controller;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Perfil;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class UsuarioController extends AbstractController
{
    #[Route('/usuario', name: 'app_usuario')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
    }

    #[Route('/usuario/new', name: 'newUsuario')]
    public function crearEstilo(EntityManagerInterface $e){
        $perfilRep=$e->getRepository(Perfil::class);
        $perfil=$perfilRep->find(1);

        $fecha=new DateTime('1990-09-12');

        $usuario=new usuario();
        $usuario->setEmail('example@gustavo.com');
        $usuario->setNombre('Gustavo');
        $usuario->setPassword('123');
        $usuario->setFechaNacimiento($fecha);
        $usuario->setPerfil($perfil);
        $e->persist($usuario);
        $e->flush();

        return $this->json([
            'message' => 'usuario creado!',
            'path' => 'src/Controller/EstiloController.php',
        ]);
    }
}
