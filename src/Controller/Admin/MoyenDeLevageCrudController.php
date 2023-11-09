<?php

namespace App\Controller\Admin;

use App\Entity\MoyenDeLevage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MoyenDeLevageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MoyenDeLevage::class;
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
