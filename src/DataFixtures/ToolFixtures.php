<?php

namespace App\DataFixtures;

use App\Entity\Tool;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ToolFixtures extends Fixture implements DependentFixtureInterface
{

    const SUBCATEGORIES = [

        'HR' => [
            'Modèles de support aux Entretiens Annuels',
            'Modèles de support aux Entretiens Professionnels',
            'Modèle de Fiche de Poste',
            'Modèle de rédaction d\'une annonce',
            'Modèle de support d\'entretin d\'embauche (Savoir-Être)',
            'Modèles divers de Compte-Rendu de réunion'
        ],

        'BUSINESS' => [
            'Liste d\'accroches téléphoniques',
            'Méthodologie d\'études de marché',
            'Conseils clés à l\'écriture d\'un pitch / d\'un argumentaire de vente',
            'Modèle de questionnnaire satisfaction client'
        ],

        'MARKETING' => [
            'Guide de création de Plaquettes Commerciales',
            'Liste de Banques d\'Images Libres de Droits',
            'Liste de Documents pouvant contribuer à la Notoriété d\'une Entreprise',
            'Idées de Campagnes de Communication',
            'Divers modèles'
        ],

        'PROJECTS' => [
            'Modèle de Compte Rendu de Réunion dans le cadre de la Gestion de Projets',
            'Méthodologie en Gestion de Projets',
            'Modèle de Planifiation en Gestion de Projets',
            'Modèle d\'Analyse de Réparition des Temps'
        ],

        'TRAINING' => [
            'Modèle de liste de présence',
            'Modèle de convocation',
            'TODO-list de l\'organisation d\'ne formation en Interne',
            'TODO-list de l\'organisation d\'ne formation en Externe'
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;

        foreach (self::SUBCATEGORIES as $category => $tools) {
            foreach ($tools as $key => $toolName) {
                $tool = new Tool();
                $tool->setName($toolName);
                $tool->setCategory($this->getReference('categories_' . $i));
                $this->addReference('tools_' . $toolName, $tool);

                $manager->persist($tool);
            }
            $i++;
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
        return [CategoryFixtures::class];
    }
}
