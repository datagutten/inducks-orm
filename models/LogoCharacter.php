<?php

namespace datagutten\InducksORM\models;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'inducks_logocharacter')]
class LogoCharacter
{
    function __construct(
        #[ORM\Id, ORM\Column(type: Types::STRING)]
        private string $entrycode,
        #[ORM\Id, ORM\Column(type: Types::STRING)]
        private string $charactercode,
    )
    {
    }

    #[ORM\ManyToOne(targetEntity: Entry::class, inversedBy: 'logos')]
    #[ORM\JoinColumn(name: 'entrycode', referencedColumnName: 'entrycode')]
    private Entry $entry;

    #[ORM\ManyToOne(targetEntity: Character::class, inversedBy: 'logos')]
    #[ORM\JoinColumn(name: 'charactercode', referencedColumnName: 'charactercode')]
    private Character $character;

    #[ORM\Column(type: Types::STRING)]
    private string $reallyintitle;

    #[ORM\Column(type: Types::INTEGER)]
    private int $number;

    #[ORM\Column(name: 'logocharactercomment')]
    private string $logoCharacterComment;

    public function getEntryCode(): string
    {
        return $this->entrycode;
    }

    public function getCharacterCode(): string
    {
        return $this->charactercode;
    }

    public function getReallyInTitle(): bool
    {
        return $this->reallyintitle == 'Y';
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getLogoCharacterComment(): string
    {
        return $this->logoCharacterComment;
    }

    public function getEntry(): Entry
    {
        return $this->entry;
    }

    public function getCharacter(): Character
    {
        return $this->character;
    }
}