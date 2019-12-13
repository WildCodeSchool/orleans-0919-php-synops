<?php

namespace App\DataFixtures;

use App\Entity\Tool;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ToolFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i<20 ; $i++){
            $tool = new Tool();
            $tool->setName($faker->realText(100));
            $tool->setCategory($this->getReference('category_' . rand(0, 4)));

            $manager->persist($tool);
        }

        $manager->flush();
    }
}
