<?php

namespace App\Controller\Admin;

use App\Entity\DescriptionMoyen;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DescriptionMoyenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DescriptionMoyen::class;
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
