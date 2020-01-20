<?php

namespace App\DataFixtures;

use App\Entity\Article;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setTitle($faker->realText(50));
            $article->setContent($faker->paragraph(15));
            $article->setDate($faker->dateTime);
            $article->setUpdatedAt(new DateTime());
            $article->setFilename('placeholder.png');
            $article->setSection($this->getReference('section_' . rand(0, 9)));
            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [SectionFixtures::class];
    }
}
