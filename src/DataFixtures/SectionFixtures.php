<?php

namespace App\DataFixtures;

use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class SectionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $section = new Section();
            $section->setName(ucfirst($faker->word));
            $section->setColor($faker->hexColor);
            $this->addReference('section_' . $i, $section);
            $manager->persist($section);
        }

        $manager->flush();
    }
}
