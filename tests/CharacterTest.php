<?php

use datagutten\InducksORM\models\Appearance;
use datagutten\InducksORM\models\Character;
use datagutten\InducksORM\models\Universe;
use datagutten\InducksORM\models\UniverseCharacter;
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

    public function testAppearances()
    {
        $character = InducksORMBootstrap()->find(Character::class, 'Anacleto');
        /** @var Appearance $appearance */
        $appearance = $character->getAppearances()->first();
        $this->assertEquals('I PK   68-1A', $appearance->getStoryversion()->getStoryCode());
    }

    public function testFirstApperances()
    {
        $character = InducksORMBootstrap()->find(Character::class, 'Anacleto');
        /** @var Appearance $appearance */
        $appearance = $character->getFirstAppearance();
        $story = $appearance->getStoryversion()->getStory();
        $this->assertEquals('I TL  516-A', $story->getStorycode());
    }

    public function testUniverses()
    {
        $character = InducksORMBootstrap()->find(Character::class, 'MM');
        $universes = $character->getUniverses();
        /** @var UniverseCharacter $universe */
        $universe = $universes->first();
        $this->assertInstanceOf(UniverseCharacter::class, $universes->first());
        $this->assertInstanceOf(Universe::class, $universe->getUniverse());
        $this->assertInstanceOf(Character::class, $universe->getCharacter());
    }
}
