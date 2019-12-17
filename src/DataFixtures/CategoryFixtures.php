<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Conduite et gestion de projets',
        'Appui marketing & communication',
        'Formation',
        'Accompagnement RH',
        'Appui commercial'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $sector) {
            $category = new Category();
            $category->setSector($sector);
            $this->addReference('categories_' . $key, $category);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
