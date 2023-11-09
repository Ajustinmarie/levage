<?php

namespace App\Controller\Admin;

use App\Entity\DescriptionMoyen;
use App\Entity\Emplacement;
use App\Entity\Fournisseur;
use App\Entity\MotifBV;
use App\Entity\MoyenDeLevage;
use App\Entity\StatusBv;
use App\Entity\StatusMoyen;
use App\Entity\StatusMoyen2;
use App\Entity\User;
use App\Entity\ZoneService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Telma Gestion des Moyens de Levage');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('The Label', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Description des Moyens', 'fas fa-user', DescriptionMoyen::class);
        yield MenuItem::linkToCrud('Emplacement des moyens', 'fas fa-user', Emplacement::class);
        yield MenuItem::linkToCrud('Emplacement des moyens', 'fas fa-user', Emplacement::class);
        yield MenuItem::linkToCrud('Fournisseurs', 'fas fa-user', Fournisseur::class);
        yield MenuItem::linkToCrud('Motif Non conformité Bureau Veritas', 'fas fa-user', MotifBV::class);
        yield MenuItem::linkToCrud('Moyen de levage', 'fas fa-user', MoyenDeLevage::class);
        yield MenuItem::linkToCrud('Status Bureau Veritas', 'fas fa-user', StatusBv::class);
        yield MenuItem::linkToCrud('Status Moyen', 'fas fa-user', StatusMoyen::class);
        yield MenuItem::linkToCrud('Zone Service', 'fas fa-user', ZoneService::class);
       yield MenuItem::linkToCrud('Status Moyen2', 'fas fa-user', StatusMoyen2::class);
    }
}
