<?php

namespace App\Controller\Admin;


use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Entity\Cancion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CancionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cancion::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titulo'),
            IntegerField::new('duracion'),
            TextField::new('album'),
            TextField::new('autor'),
            AssociationField::new( 'genero', 'Estilo'),
            IntegerField::new('likes'),
            IntegerField::new('reproducciones'),
            TextField::new('foto')
        ];
    }
    
}
