<?php

use datagutten\InducksORM\models\Character;
use datagutten\InducksORM\models\Universe;
use datagutten\InducksORM\models\UniverseCharacter;
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
}
