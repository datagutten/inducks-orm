<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'inducks_ucrelation')]
#[ORM\Entity(readOnly: true)]
class UniverseCharacter
{
    public function __construct(
        #[ORM\Id, ORM\Column(type: 'string')]
        private string $universecode,
        #[ORM\Id, ORM\Column(type: 'string')]
        private string $charactercode,
    )
    {
    }

    #[ORM\ManyToOne(targetEntity: Universe::class, inversedBy: 'characters')]
    #[ORM\JoinColumn(name: 'universecode', referencedColumnName: 'universecode')]
    private Universe $universe;

    #[ORM\ManyToOne(targetEntity: Character::class, inversedBy: 'universes')]
    #[ORM\JoinColumn(name: 'charactercode', referencedColumnName: 'charactercode')]
    private Character $character;

    /**
     * @return string
     */
    public function getUniverseCode(): string
    {
        return $this->universecode;
    }

    /**
     * @return string
     */
    public function getCharacterCode(): string
    {
        return $this->charactercode;
    }

    /**
     * @return Universe
     */
    public function getUniverse(): Universe
    {
        return $this->universe;
    }

    /**
     * @return Character
     */
    public function getCharacter(): Character
    {
        return $this->character;
    }
}