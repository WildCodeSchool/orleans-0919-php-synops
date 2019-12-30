<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $member = new User();
        $member->setEmail('member@gmail.com');
        $member->setRoles(['ROLE_MEMBER']);
        $member->setPassword($this->passwordEncoder->encodePassword(
            $member,
            'memberpassword'
        ));

        $manager->persist($member);
        $manager->flush();
    }
}
