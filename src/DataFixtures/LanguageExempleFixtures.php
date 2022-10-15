<?php

namespace App\DataFixtures;

use App\Entity\LanguageExemple;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LanguageExempleFixtures extends Fixture
{

    public const LANGUAGE_EXEMPLE_PY = "languageExemplePy";

    public function load(ObjectManager $manager): void
    {
        $languageExemplePy = new LanguageExemple();
        $languageExemplePy->setCode("For machin");
        $languageExemplePy->setExecution(2);
        $languageExemplePy->setLanguage($this->getReference(LanguageFixtures::LANGUAGE_PYTHON_FIXTURES));


        $manager->persist($languageExemplePy);

        $manager->flush();

        $this->addReference(self::LANGUAGE_EXEMPLE_PY, $languageExemplePy);
    }
}
