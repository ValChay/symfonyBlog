<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Proxies\__CG__\App\Entity\Author;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

;

class AuthorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
       $trump = new Author();
       $vladimir = new Author();
       $kimjun = new Author();

       $trump
           ->setName("Trump")
           ->setBirth(new \DateTime('1991/06/19'))
           ->setJob('orange')
           ->setUser($this->getReference('user-val'));

        $manager->persist($trump);
        $this->addReference('author-trump',$trump);

        $vladimir
           ->setName("Vladimir")
           ->setBirth(new \DateTime('1991/06/19'))
           ->setJob('disctateur');
        $manager->persist($vladimir);
        $this->addReference('author-vladimir',$vladimir);

        $kimjun
           ->setName("Kim jun un")
           ->setBirth(new \DateTime('1991/06/19'))
           ->setJob('Geolier');

        $manager->persist($kimjun);
        $this->addReference('author-kim',$kimjun);

        $manager->flush();
    }

    // il faudra chargé les fixtures des users avant daffiché la référence
    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
