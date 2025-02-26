<?php

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Playlist;
use App\Entity\PlaylistCancion;


class PlaylistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('visibilidad')
            ->add('playlistCanciones', CollectionType::class, [
                'entry_type' => PlaylistCancionType::class, // Usa un formulario embebido
                'allow_add' => true,  // Permite agregar nuevas canciones
                'allow_delete' => true,  // Permite eliminar canciones
                'by_reference' => false, // Necesario para relaciones OneToMany
                'prototype' => true, // Permite clonar campos en JS
                'prototype_name' => '__name__', // Nombre de prototipo
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Playlist::class,
        ]);
    }
}

