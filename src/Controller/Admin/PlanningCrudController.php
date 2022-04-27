<?php

namespace App\Controller\Admin;

use App\Entity\Planning;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlanningCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Planning::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('description'),
            DateField::new('date'),
            TimeField::new('heure_debut'),
            TimeField::new('heure_fin'),
            EmailField::new('adresse_mail'),
        ];
    }
}
