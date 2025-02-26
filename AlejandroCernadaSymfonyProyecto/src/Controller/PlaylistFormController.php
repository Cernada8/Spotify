<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use PlaylistType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistFormController extends AbstractController
{
    #[Route('/user/crearPlaylist', name: 'app_crearPlaylist')]
    public function crearPlaylist(Request $request, EntityManagerInterface $entityManager): Response
    {

        $session=$request->getSession();
        $email=$session->get('_security.last_username');

        $usuarioRep=$entityManager->getRepository(Usuario::class);
        $usuario=$usuarioRep->findOneByEmail($email);

        $playlist = new Playlist();
        $playlist->setPropietario($usuario);
        $playlist->setReproducciones(0);
        $playlist->setLikes(0);
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($playlist);
            $entityManager->flush();
    
            return new RedirectResponse('/index.html');        }
    
        return $this->render('playlist_form/playlist.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
