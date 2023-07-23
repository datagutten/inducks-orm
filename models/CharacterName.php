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
    function __construct(
        #[ORM\Id, ORM\Column(type: 'string')]
        private string $charactercode,
        #[ORM\Id, ORM\Column(type: 'string')]
        private string $languagecode,
        #[ORM\Id, ORM\Column(type: 'string')]
        private string $charactername,
    )
    {
    }

    #[ORM\ManyToOne(targetEntity: Character::class, inversedBy: 'names')]
    #[ORM\JoinColumn(name: 'charactercode', referencedColumnName: 'charactercode')]
    private Character $character;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'characterNames')]
    #[ORM\JoinColumn(name: 'languagecode', referencedColumnName: 'languagecode')]
    private Language $language;

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

    public function getLanguage(): Language
    {
        return $this->language;
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

    public function __toString(): string
    {
        return $this->charactername;
    }
}
