<?php

namespace App\DataFixtures;

use App\Entity\LanguageExemple;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AAAFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
    }

    public function getDependencies(): array
    {
        return [
            LanguageExecutionFixtures::class,
            LanguageFixtures::class,
            LanguageExempleFixtures::class,
            LanguageExempleTypeFixtures::class,
            ParadigmeFixtures::class,
            LanguageParadigmeFixtures::class
        ];
    }

}
