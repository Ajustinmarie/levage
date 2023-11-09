<?php

namespace App\Controller\Admin;

use App\Entity\ZoneService;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ZoneServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ZoneService::class;
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
