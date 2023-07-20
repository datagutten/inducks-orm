<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharacterName
 *
 *
 * @author dromanin
 */
#[ORM\Table(name: 'inducks_charactername')]
#[ORM\Entity(readOnly: true)]
class CharacterName
{
    #[ORM\ManyToOne(targetEntity: Character::class, inversedBy: 'names')]
    #[ORM\JoinColumn(name: 'charactercode', referencedColumnName: 'charactercode')]
    #[ORM\Id]
    private Character $character;

    #[ORM\Column(type: 'string')]
    #[ORM\Id]
    private string $languagecode;

    #[ORM\Column(type: 'string')]
    private string $charactername;

    #[ORM\Column(type: 'string')]
    private string $preferred;

    #[ORM\Column(type: 'string')]
    private string $characternamecomment;

    function getCharacter(): Character
    {
        return $this->character;
    }

    function getLanguagecode(): string
    {
        return $this->languagecode;
    }

    function getCharactername(): string
    {
        return $this->charactername;
    }

    function isPreferred(): bool
    {
        return $this->preferred ? 'Y' : 'N';
    }

    function getPreferred(): string
    {
        return $this->preferred;
    }

    function getCharacternamecomment(): string
    {
        return $this->characternamecomment;
    }
}