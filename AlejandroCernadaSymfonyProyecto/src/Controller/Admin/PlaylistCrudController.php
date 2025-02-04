<?php

namespace App\Controller\Admin;

use App\Entity\Playlist;
use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;



class PlaylistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Playlist::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nombre'),
            TextField::new('visibilidad'),
            AssociationField::new('propietario', 'Usuario')->setFormTypeOption('by_reference', false),
            IntegerField::new('reproducciones'), 
            IntegerField::new('likes')
        ];
    }
    
}
