<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Gadget;

class GadgetFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //create our gadgets
        //1
        $tshirt = new Gadget([
            'type' => 'T-shirt',
            'description' => '100% fine jersey cotton, relaxed fit, unisex, Made in EU.',
            'samplePicture' => 'tshirt.jpg',
        ]);
        $manager->persist($tshirt);

        //2
        $mousepad = new Gadget([
            'type' => 'Mousepad',
            'description' => 'Water repellent, high precision, non-slip rubber base, designed by gamers and very suitable for gaming/office work.',
            'samplePicture' => 'mousepad.jpg',
        ]);
        $manager->persist($mousepad);

        //3
        $mousepad = new Gadget([
            'type' => 'Poster',
            'description' => 'Laminated, tear-resistant, very durable, high quality ink.',
            'samplePicture' => 'poster.jpg',
        ]);
        $manager->persist($mousepad);

        $manager->flush();
    }
}
