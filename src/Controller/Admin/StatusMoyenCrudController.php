<?php

namespace App\Controller\Admin;

use App\Entity\StatusMoyen;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StatusMoyenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatusMoyen::class;
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
