<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixture extends Fixture
{
    private $pswEncoder;

    public function __construct(UserPasswordEncoderInterface $pswEncoder) 
    {
        $this->pswEncoder = $pswEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for($i=0;$i<3;$i++)
        {
            $user = new user();
            $user->setEmail("Email$i@gmail.com")
                 ->setPassword($this->pswEncoder->encodePassword($user, "Some gracious salt on the land of the seum"));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
