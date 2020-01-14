<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    const TEAMS = [
        'Anne' => [
            'firstname' => 'Anne',
            'lastname' => 'd\'HERBIGNY',
            'email' => 'https://www.linkedin.com/in/anne-dherbigny/',
            'description' => 'Anne a une expérience d’une dizaine d’années notamment dans le BTP,
             la finance et l’industrie, sur des
            fonctions supports clés.
            Elle est titulaire d’une Maîtrise des Sciences Techniques, Comptables & Financières.
            Experte dans l’appréhension des enjeux globaux des entreprises et l’impact des décisions stratégiques, elle
            s’attache à placer l’Humain au cœur de toutes actions et privilégie un développement éthique.
            Dotée d’une solide capacité d’écoute et d’un dynamisme communicatif, elle est mue par l’envie d’accompagner
            les organisations dans le respect de chacun vers des réussites collectives !',
            'picture' => 'anne.webp',
        ],
        'Quitterie' => [
            'firstname' => 'Quitterie',
            'lastname' => 'BAURÈS',
            'email' => 'https://www.linkedin.com/in/quitterie-baurès-533547a8/',
            'description' => 'Quitterie a travaillé une dizaine d’années en TPE-PME & associations patronales.
            De formation initiale Assistante de Direction, elle a par la suite occupé des fonctions commerciales et
            managériales, en passant par le développement de compétences marketing/communication. 
            Elle a acquis une solide expertise dans l’accompagnement du dirigeant à la mise en place de son plan
            d’action avec une approche transversale.
            De nature impliquée, passionnée par les relations humaines, elle met en œuvre une approche responsable des
            problématiques d’entreprise pour plus de bien-être et de performance !',
            'picture' => 'quitterie.webp',
        ],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::TEAMS as $team => $data) {
            $team = new Team();
            $team->setFirstname($data['firstname']);
            $team->setLastname($data['lastname']);
            $team->setEmail($data['email']);
            $team->setDescription($data['description']);
            $team->setPicture($data['picture']);
            $manager->persist($team);
        }

        $manager->flush();
    }
}
