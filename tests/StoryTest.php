<?php


use datagutten\InducksORM\models\HeroCharacter;
use datagutten\InducksORM\models\Story;
use PHPUnit\Framework\TestCase;

class StoryTest extends TestCase
{
    public function testGetHero()
    {
        $story = InducksORMBootstrap()->find(Story::class, 'D 91048');
        $this->assertEquals('US', $story->getHero()->getCharactercode());
    }

    public function testGetHero2()
    {
        /**
         * @var HeroCharacter $herochar
         */
        $herochar = InducksORMBootstrap()->find(HeroCharacter::class, 'D 91048');
        $this->assertEquals('US', $herochar->getCharacterCode());
        $this->assertEquals('Home By The Sea', $herochar->getStory()->getTitle());
    }
}
