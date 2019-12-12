<?php

namespace App\DataFixtures;

use App\Entity\Partner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PartnerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $partner = new Partner();
            $partner->setName(ucfirst($faker->word));
            $partner->setLogo($faker->imageUrl());
            $partner->setLink($faker->url);
            $manager->persist($partner);
        }

        $manager->flush();
    }
}
