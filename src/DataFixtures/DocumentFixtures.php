<?php

namespace App\DataFixtures;

use App\Entity\Document;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class DocumentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        foreach (ToolFixtures::SUBCATEGORIES as $tools) {
            foreach ($tools as $toolName) {
                for ($i = 0; $i < 5; $i++) {
                    $document = new Document();

                    $document->setDescription($faker->realText(100));
                    $document->setName($faker->realText(10));
                    $document->setTool($this->getReference('tools_' . $toolName));
                    $document->setUpdatedAt(new DateTime());
                    $document->setMimeTypeFile($faker->mimeType);
                    $document->setFileName('');

                    $manager->persist($document);
                }
            }
        }
        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [ToolFixtures::class];
    }
}
