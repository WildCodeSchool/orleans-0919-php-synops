<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture implements DependentFixtureInterface
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
        $member->setName('memberName');
        $member->setCompany('memberCompany');
        $member->setPhone('memberPhone');
        $member->setPassword($this->passwordEncoder->encodePassword(
            $member,
            'memberpass'
        ));

        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpass'
        ));

        $manager->persist($member);
        $manager->persist($admin);

        $faker = Faker\Factory::create('fr,FR');
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setName($faker->name);
            $user->setCompany($faker->company);
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            $user->setPhone($faker->phoneNumber);
            $user->setRoles(['ROLE_MEMBER']);
            $user->addCategory($this->getReference('categories_'.rand(0, 4)));
            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
