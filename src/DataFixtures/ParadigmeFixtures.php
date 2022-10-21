<?php

namespace App\DataFixtures;

use App\Entity\Paradigme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ParadigmeFixtures extends Fixture
{

    public const PARADIGME_IMP_FIXTURES = 'paradigmeImp';

    public function load(ObjectManager $manager): void
    {

        $paradigmeImp = new Paradigme();
        $paradigmeImp->setName("La programmation impérative");

        $manager->persist($paradigmeImp);

        $manager->flush();

        $this->addReference(self::PARADIGME_IMP_FIXTURES, $paradigmeImp);

    }
}
