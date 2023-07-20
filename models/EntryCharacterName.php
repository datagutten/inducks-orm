<?php

namespace datagutten\InducksORM\models;


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'inducks_entrycharactername')]
class EntryCharacterName
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private string $entrycode;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'entrycode', referencedColumnName: 'entrycode')]
    private Entry $entry;

    #[ORM\Column(type: 'string')]
    private string $charactercode;

    #[ORM\ManyToOne(inversedBy: 'entryNames')]
    #[ORM\JoinColumn(name: 'charactercode', referencedColumnName: 'charactercode')]
    private Character $character;

    #[ORM\Column(type: 'string')]
    private string $charactername;

    public function getEntryCode(): string
    {
        return $this->entrycode;
    }

    public function getEntry(): Entry
    {
        return $this->entry;
    }

    public function getCharacterCode(): string
    {
        return $this->charactercode;
    }

    public function getCharacter(): Character
    {
        return $this->character;
    }

    public function getCharacterName(): string
    {
        return $this->charactername;
    }

    public function getIssue(): Issue
    {
        return $this->entry->getIssue();
    }

    public function getLanguage(): Language
    {
        return $this->entry->getIssue()->getPublication()->getLanguage();
    }
}