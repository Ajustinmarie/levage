<?php

namespace App\Controller\Admin;

use App\Entity\Emplacement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EmplacementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Emplacement::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
