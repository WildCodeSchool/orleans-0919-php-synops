<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setTitle($faker->realText(50));
            $article->setContent($faker->paragraph(15));
            $article->setDate($faker->dateTime);
            $article->setPicture($faker->imageUrl(200, 200));
            $manager->persist($article);
        }

        $manager->flush();
    }
}