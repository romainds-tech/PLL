<?php

namespace App\DataFixtures;

use App\Entity\LanguageExecution;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageExecutionFixtures extends Fixture
{
    public const LANGUAGE_EXECUTION_T_FIXTURES = 'languageExecutionT';
    public const LANGUAGE_EXECUTION_C_FIXTURES = 'languageExecutionC';
    public const LANGUAGE_EXECUTION_I_FIXTURES = 'languageExecutionI';


    public function load(ObjectManager $manager): void
    {

        $languageExecutionT = new LanguageExecution();
        $languageExecutionT->setName("Transpiler");

        $languageExecutionC = new LanguageExecution();
        $languageExecutionC->setName("Compiler");

        $languageExecutionI = new LanguageExecution();
        $languageExecutionI->setName("Interpreter");

        $languageExecutionI->addLanguage($this->getReference(LanguageFixtures::LANGUAGE_PYTHON_FIXTURES));


        $manager->persist($languageExecutionT);
        $manager->persist($languageExecutionC);
        $manager->persist($languageExecutionI);

        $manager->flush();

        $this->addReference(self::LANGUAGE_EXECUTION_T_FIXTURES, $languageExecutionT);
        $this->addReference(self::LANGUAGE_EXECUTION_C_FIXTURES, $languageExecutionC);
        $this->addReference(self::LANGUAGE_EXECUTION_I_FIXTURES, $languageExecutionI);

    }


}
