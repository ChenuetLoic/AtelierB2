<?php

namespace App\DataFixtures;

use App\Entity\Projets;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjetFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $projet = new Projets();
        $projet->setTitle('Projet 1');
        $projet->setDescription('Une description');
        $manager->persist($projet);

        $manager->flush();
    }
}
