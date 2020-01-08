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
        $member->setFirstname('John');
        $member->setLastname('Doe');
        $member->setFunction('Employé');
        $member->setField('Tertiaire');
        $member->setCompany('Member Company');
        $member->setPhone('06 00 00 00 00');
        $member->setPassword($this->passwordEncoder->encodePassword(
            $member,
            'memberpass'
        ));

        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstname('Alexandre');
        $admin->setLastname('COULON');
        $admin->setFunction('Élève');
        $admin->setField('Developpement Web');
        $admin->setCompany('Wild Code School');
        $admin->setPhone('07 00 00 00 00');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpass'
        ));

        $manager->persist($member);
        $manager->persist($admin);

        $faker = Faker\Factory::create('fr,FR');
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setCompany($faker->company);
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->email);
            $user->setField($faker->word);
            $user->setFunction($faker->word);
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
