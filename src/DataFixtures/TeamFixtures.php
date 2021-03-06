<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;

class TeamFixtures extends Fixture
{
    const TEAMS = [
        'Anne' => [
            'firstname' => 'Anne',
            'lastname' => 'd\'HERBIGNY',
            'email' => 'anne@syn-ops.fr',
            'linkedin' => 'https://www.linkedin.com/in/anne-dherbigny/',
            'phone' => '06 66 90 77 95',
            'description' => 'Anne a une expérience d’une dizaine d’années notamment dans le BTP,
             la finance et l’industrie, sur des
            fonctions supports clés.
            Elle est titulaire d’une Maîtrise des Sciences Techniques, Comptables & Financières.
            Experte dans l’appréhension des enjeux globaux des entreprises et l’impact des décisions stratégiques, elle
            s’attache à placer l’Humain au cœur de toutes actions et privilégie un développement éthique.
            Dotée d’une solide capacité d’écoute et d’un dynamisme communicatif, elle est mue par l’envie d’accompagner
            les organisations dans le respect de chacun vers des réussites collectives !',
            'imagename' => 'anne.webp',
            'updated_at' => '',
        ],
        'Quitterie' => [
            'firstname' => 'Quitterie',
            'lastname' => 'BAURÈS',
            'email' => 'quitterie@syn-ops.fr',
            'linkedin' => 'https://www.linkedin.com/in/quitterie-baurès-533547a8/',
            'phone' => '06 82 27 91 96',
            'description' => 'Quitterie a travaillé une dizaine d’années en TPE-PME & associations patronales.
            De formation initiale Assistante de Direction, elle a par la suite occupé des fonctions commerciales et
            managériales, en passant par le développement de compétences marketing/communication. 
            Elle a acquis une solide expertise dans l’accompagnement du dirigeant à la mise en place de son plan
            d’action avec une approche transversale.
            De nature impliquée, passionnée par les relations humaines, elle met en œuvre une approche responsable des
            problématiques d’entreprise pour plus de bien-être et de performance !',
            'imagename' => 'quitterie.webp',
            'updated_at' => '',
        ],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::TEAMS as $team => $data) {
            $team = new Team();
            $team->setFirstname($data['firstname']);
            $team->setLastname($data['lastname']);
            $team->setEmail($data['email']);
            $team->setLinkedin($data['linkedin']);
            $team->setPhone($data['phone']);
            $team->setDescription($data['description']);
            $team->setImageName($data['imagename']);
            $team->setUpdatedAt(new DateTime());

            $manager->persist($team);
        }

        $manager->flush();
    }
}
