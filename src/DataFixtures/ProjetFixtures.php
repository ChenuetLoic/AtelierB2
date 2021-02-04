<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjetFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $projet = new Project();
        $projet->setTitle('Projet 1');
        $projet->setDescriptionHome('Petite description courte');
        $projet->setDescription("Cet appartement de 140 m² ne proposait que 2 chambres et ne convenait pas à 
        une jeune famille ; après plusieurs échanges avec les propriétaires nous sommes arrivés à atteindre l'objectif.
        À savoir, un logement regroupant 4 chambres, 2 salle de bains, 1 WC invités et un espace cuisine/salle 
        à manger/séjour très aérien avec une belle superficie (environ 70 m²). L'entrée a été travaillée de façon à 
         se déafin de ne 
        pas tout de suite rentrer dans la cuisine et pouvoir se déchausser confortablement.
        Sur chaque espaces, un travail sur les couleurs et matériaux a été fait rendant toutes les pièces uniques.");
        $projet->setPathHome("accueil.webp");
        $manager->persist($projet);

        $manager->flush();
    }
}
