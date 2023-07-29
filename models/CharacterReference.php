<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'inducks_characterreference')]
#[ORM\Entity(readOnly: true)]
class CharacterReference
{
    function __construct(
        #[ORM\Id, ORM\Column(type: 'string')]
        private string $fromcharactercode,
        #[ORM\Id, ORM\Column(type: 'string')]
        private string $tocharactercode,
    )
    {
    }

    #[ORM\ManyToOne(targetEntity: Character::class, inversedBy: 'referencesFrom')]
    #[ORM\JoinColumn(name: 'fromcharactercode', referencedColumnName: 'charactercode')]
    private Character $characterFrom;

    #[ORM\ManyToOne(targetEntity: Character::class, inversedBy: 'referencesTo')]
    #[ORM\JoinColumn(name: 'tocharactercode', referencedColumnName: 'charactercode')]
    private Character $characterTo;

    #[ORM\Column(type: 'string')]
    private string $isgroupofcharacters;

    public function getFromCharacterCode(): string
    {
        return $this->fromcharactercode;
    }

    public function getCharacterFrom(): Character
    {
        return $this->characterFrom;
    }

    public function getToCharacterCode(): string
    {
        return $this->tocharactercode;
    }

    public function getCharacterTo(): Character
    {
        return $this->characterTo;
    }

    public function getIsGroupOfCharacters(): bool
    {
        return $this->isgroupofcharacters == 'Y';
    }
}