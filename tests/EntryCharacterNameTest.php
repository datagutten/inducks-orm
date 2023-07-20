<?php


use datagutten\InducksORM\models;
use datagutten\InducksORM\models\Entry;
use datagutten\InducksORM\models\EntryCharacterName;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;

class EntryCharacterNameTest extends TestCase
{
    public function testEntry()
    {
        $name = InducksORMBootstrap()->find(models\EntryCharacterName::class, 'no/AAR   6dc');
        $entry = InducksORMBootstrap()->find(Entry::class, 'no/AAR   6dc');
        $this->assertEquals($entry->getTitle(), $name->getEntry()->getTitle());
    }

    public function testCharacter()
    {
        $name = InducksORMBootstrap()->find(models\EntryCharacterName::class, 'no/AAR   6dc');
        $character = InducksORMBootstrap()->find(models\Character::class, 'JW');
        $this->assertEquals($character->getCharactername(), $name->getCharacter()->getCharactername());
    }

    public function testCharacterEntryNames()
    {
        $character = InducksORMBootstrap()->find(models\Character::class, 'JW');
        $criteria = Criteria::create()->where(Criteria::expr()->eq('entrycode', 'no/DD1952-08c'));
        /** @var EntryCharacterName $name */
        $name = $character->getEntryNames()->matching($criteria)->first();
        $this->assertEquals('Spettene', $name->getCharacterName());
    }

    public function testGetIssue()
    {
        $name = InducksORMBootstrap()->find(models\EntryCharacterName::class, 'no/AAR   6dc');
        $issue = InducksORMBootstrap()->find(models\Issue::class, 'no/AAR   6');
        $this->assertEquals($issue->getTitleFull(), $name->getIssue()->getTitleFull());
    }
}
