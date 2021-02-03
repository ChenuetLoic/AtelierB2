<?php

namespace App\DataFixtures;

use App\Entity\Carousel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarouselFixtures extends Fixture
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
            $carousel = new Carousel();
            $carousel->setPath($pictureName);
            $manager->persist($carousel);
        }
        $manager->flush();
    }
}
