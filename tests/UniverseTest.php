<?php

use datagutten\InducksORM\models\Character;
use datagutten\InducksORM\models\Universe;
use datagutten\InducksORM\models\UniverseCharacter;
use datagutten\InducksORM\models\UniverseName;
use PHPUnit\Framework\TestCase;


class UniverseTest extends TestCase
{
    public function testCharacters()
    {
        $universe = InducksORMBootstrap()->find(Universe::class, 'Riverside Rovers');
        $character = $universe->getCharacters()->first();
        $this->assertInstanceOf(UniverseCharacter::class, $character);
        $this->assertInstanceOf(Character::class, $character->getCharacter());
        $this->assertEquals($universe, $character->getUniverse());
    }

    public function testLocalizedName()
    {
        $universe = InducksORMBootstrap()->find(Universe::class, 'Riverside Rovers');
        $name = $universe->getLocalizedName('no');
        $this->assertEquals('Elvebreddkameratene', $name);
    }

    public function testName()
    {
        $names = InducksORMBootstrap()->getRepository(UniverseName::class)->findBy(['universecode' => 'Riverside Rovers']);
        $this->assertNotEmpty($names);
    }
}
