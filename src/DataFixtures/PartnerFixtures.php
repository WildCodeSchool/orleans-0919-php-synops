<?php

namespace App\DataFixtures;

use App\Entity\Partner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PartnerFixtures extends Fixture
{
    const PARTNERS = [

        'LAB\'O' => [
            'logo' => 'https://i.postimg.cc/d3CVTBvt/logo-labo.png',
            'link' => 'https://www.le-lab-o.fr/',
        ],

        'Partner' => [
            'logo' => 'https://i.postimg.cc/tTvHCVxR/partner-logo.png',
            'link' => 'https://www.partnaire.fr/',
        ],

        'Spotify' => [
            'logo' => 'https://i.postimg.cc/Hx67Y3zJ/spotify-logo.png',
            'link' => 'www.spotify.com/‎',
        ],

        'Partenaire à Grande Photo et Nom' => [
            'logo' => 'https://i.postimg.cc/Bn9YKWdf/voile.png',
            'link' => 'https://i.postimg.cc/Bn9YKWdf/voile.png‎',
        ],

        'LAB\'O 2' => [
            'logo' => 'https://i.postimg.cc/d3CVTBvt/logo-labo.png',
            'link' => 'https://www.le-lab-o.fr/',
        ],

        'Partner 2' => [
            'logo' => 'https://i.postimg.cc/tTvHCVxR/partner-logo.png',
            'link' => 'https://www.partnaire.fr/',
        ],

        'Spotify 2' => [
            'logo' => 'https://i.postimg.cc/Hx67Y3zJ/spotify-logo.png',
            'link' => 'www.spotify.com/‎',
        ],

    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::PARTNERS as $name => $data) {
            $partner = new Partner();
            $partner->setName($name);
            $partner->setLogo($data['logo']);
            $partner->setLink($data['link']);
            $manager->persist($partner);

        }


        $manager->flush();
    }
}
