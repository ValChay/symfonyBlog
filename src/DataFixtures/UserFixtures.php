<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
private $encoder;
    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
       $val = new User();
       $michel = new User();
       $bob = new User();

       $val
           ->setEmail('blbdgregdfal@mdlks.com')
           ->setPassword($this->encoder->encodePassword($val,'obo'))
       ;

       $manager->persist($val);
       $this->addReference('user-val', $val);

    $michel
           ->setEmail('blbafrfdrfrl@mdlks.com')
           ->setPassword($this->encoder->encodePassword($michel,'obobo'))
    ;

       $manager->persist($michel);
        $this->addReference('user-michel', $michel);

    $bob
           ->setEmail('blbrfrdfdral@mdlks.com')
           ->setPassword($this->encoder->encodePassword($bob,'obobobo'))
    ;

       $manager->persist($bob);
        $this->addReference('user-bob', $bob);


        $manager->flush();
    }
}
