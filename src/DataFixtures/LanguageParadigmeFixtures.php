<?php

namespace App\DataFixtures;

use App\Entity\LanguageParadigme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LanguageParadigmeFixtures extends Fixture
{
    public const LANGUAGE_PARADIGME_FIXTURES = 'languageParadigme';

    public function load(ObjectManager $manager): void
    {
        $languageParadigme = new LanguageParadigme();
        $languageParadigme->setLanguageId($this->getReference(LanguageFixtures::LANGUAGE_PYTHON_FIXTURES));
        $languageParadigme->setParadigmeId($this->getReference(ParadigmeFixtures::PARADIGME_IMP_FIXTURES));

        $manager->persist($languageParadigme);

        $manager->flush();

        $this->addReference(self::LANGUAGE_PARADIGME_FIXTURES, $languageParadigme);
    }

}
