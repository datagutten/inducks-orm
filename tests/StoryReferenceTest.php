<?php

use datagutten\InducksORM\models\Story;
use PHPUnit\Framework\TestCase;


class StoryReferenceTest extends TestCase
{
    function testReferenceFrom()
    {
        $story = InducksORMBootstrap()->find(Story::class, 'AR 113');
        $references = $story->getReferencesFrom();

        $this->assertCount(2, $references);
        $this->assertEquals('W DD   51-02', $references[0]->getToStory()->getStoryCode());
        $this->assertEquals('W OS  456-02', $references[1]->getToStory()->getStoryCode());
    }
}
