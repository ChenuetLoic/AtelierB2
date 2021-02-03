<?php

namespace App\DataFixtures;

use App\Entity\PicturesProjet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PicturesProjetFixtures extends Fixture
{
    private const PICTURE = [
        "accueil.webp",
        "bureau.webp",
        "chambre.webp",
        "salon.webp",
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PICTURE as $pictureName) {
            $picturesProjet = new PicturesProjet();
            $picturesProjet->setPictures($pictureName);
            $manager->persist($picturesProjet);
    }
        $manager->flush();
    }
}
