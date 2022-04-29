<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Planning;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class AdminController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // l'accès est interdit à ceux qui n'ont pas le rôle admin
        // $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Vous n\'avez pas accès à cette page !');

        $users = $this->getDoctrine()->getRepository(Utilisateur::class)->count([]);
        $article = $this->getDoctrine()->getRepository(Article::class)->count([]);
        $planning = $this->getDoctrine()->getRepository(Planning::class)->count([]);
        return $this->render('Admin/dashboard.html.twig', [
            'users' => $users,
            'article' => $article,
            'planning' => $planning
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ADMINISTRATION');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user-circle', Utilisateur::class);
        yield MenuItem::linkToRoute('Ajouter un utilisateur', 'fa fa-user', 'security_registration');
        yield MenuItem::linkToCrud('Solution GET-MS', 'fa fa-file-text-o', Article::class);
        yield MenuItem::linkToCrud('Rendez-vous', 'fa fa-envelope', Planning::class);

    }
}