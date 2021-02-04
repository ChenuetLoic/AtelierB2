<?php

namespace App\DataFixtures;

use App\Entity\Prestation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PrestationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $prestation = new Prestation();
        $prestation->setPicture("accueil.webp");
        $manager->persist($prestation);

        $manager->flush();
    }
}
