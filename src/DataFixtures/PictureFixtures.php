<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $prestation = new Picture();
        $prestation->setPath("accueil.webp");
        $manager->persist($prestation);


        $manager->flush();
    }
}
