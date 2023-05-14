<?php


use datagutten\InducksORM\models\Character;
use Doctrine\ORM\EntityNotFoundException;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{

    public function testGetLocalizedName()
    {
        $character = InducksORMBootstrap()->find(Character::class, 'GO');
        $this->assertEquals('Langbein', $character->getLocalizedName('no'));
        $this->assertEquals('Fedtmule', $character->getLocalizedName('da'));
    }

    public function testGetPreferredLocalizedName()
    {
        $character = InducksORMBootstrap()->find(Character::class, 'MCP');
        $this->assertEquals('Donald Villand', $character->getLocalizedName('no'));
        $this->assertEquals('Donald McWild Duck', $character->getLocalizedName('no', false));
    }

    public function testInvalidName()
    {
        $this->expectException(EntityNotFoundException::class);
        $character = InducksORMBootstrap()->find(Character::class, 'GO');
        $character->getLocalizedName('no', false);
    }
}
