<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUser extends Fixture
{
    const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {

        for($i = 0; $i < 3; $i++){
            $user = new User();

            $user->setFirstname('John'.$i);
            $user->setLastname('Doe');
            $user->setEmail('user'.$i.'@exemple.org');
            $user->setIsAuthor(true);

            $password = $this->container->get('security.password_encoder')->encodePassword($user, self::USER_PASSWORD);
            $user->setPassword($password);

            $this->addReference('user'.$i, $user);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
