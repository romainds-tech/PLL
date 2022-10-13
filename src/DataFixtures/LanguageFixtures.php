<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public const LANGUAGE_PYTHON_FIXTURES = 'LANGUAGE_PYTHON';

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $language = new Language();
        $language->setName('Python');
        $language->setTyped(true);
        $language->setDescription('Python is a programming language that lets you work quickly and integrate systems more effectively.');
        $language->setExecutionSpeed(5);
        $language->setDeveloppementSpeed(5);
        $language->setDocumentation('https://docs.python.org/3/');
        $language->setRepository('https://github.com/python/cpython');

        $language->addLanguageParadigme($this->getReference(LanguageParadigmeFixtures::LANGUAGE_PARADIGME_FIXTURES));
        $language->addLanguageExemple($this->getReference(LanguageExempleFixtures::LANGUAGE_EXEMPLE_PY));

        $this->addReference(self::LANGUAGE_PYTHON_FIXTURES, $language);

        $manager->persist($language);

        $manager->flush();
    }
}
