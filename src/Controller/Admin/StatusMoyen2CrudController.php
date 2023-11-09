<?php

namespace App\Controller\Admin;

use App\Entity\StatusMoyen2;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StatusMoyen2CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatusMoyen2::class;
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
