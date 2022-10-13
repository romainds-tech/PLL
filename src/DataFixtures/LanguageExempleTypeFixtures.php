<?php

namespace App\DataFixtures;

use App\Entity\LanguageExempleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageExempleTypeFixtures extends Fixture
{
    public const LANGUAGE_EXEMPLE_TYPE_PY_VAR = "languageExempleTypePyVar";
    public const LANGUAGE_EXEMPLE_TYPE_PY_FUNC = "languageExempleTypePyFunc";

    public function load(ObjectManager $manager): void
    {
        $languageExempleTypeVar = new LanguageExempleType();
        $languageExempleTypeVar->setName('Variable');
        $languageExempleTypeVar->setDescription('A variable is a named location used to store data in the memory.
         It is helpful to think of variables as containers that hold information. 
         Its sole purpose is to label and store data in memory. 
         This data can then be used throughout your program. 
         Each variable in Python has a type. 
         Variables that have numeric values are of type int. 
         Variables that have decimal values are of type float. 
         And variables that have values consisting of letters or other characters are of type str (short for string).');

        $languageExempleTypeFunc = new LanguageExempleType();
        $languageExempleTypeFunc->setName('Function');
        $languageExempleTypeFunc->setDescription('A function is a block of organized,
         reusable code that is used to perform a single, related action.');

        $manager->persist($languageExempleTypeVar);
        $manager->persist($languageExempleTypeFunc);

        $this->addReference(self::LANGUAGE_EXEMPLE_TYPE_PY_VAR, $languageExempleTypeVar);
        $this->addReference(self::LANGUAGE_EXEMPLE_TYPE_PY_FUNC, $languageExempleTypeFunc);

        $manager->flush();

    }
}
