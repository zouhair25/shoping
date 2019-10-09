<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

 use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('demo');
        $user->setEmail('demo@gmail.com');
        $user->setTel('0657432812');
        $user->setAdress('demo');
        $user->setActive(1);
        $user->setCreatedAt(new \DateTime());
        $user->setPassword($this->passwordEncoder->encodePassword($user,'demo'));

        $manager->persist($user);

        $manager->flush();
    }
}
