<?php

namespace datagutten\InducksORM\models;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

#[ORM\Table(name: 'inducks_universe')]
#[ORM\Entity(readOnly: true)]
class Universe
{
    #[ORM\Id, ORM\Column(type: Types::STRING)]
    private string $universecode;

    #[ORM\Column(type: Types::STRING)]
    private string $universecomment;

    #[ORM\OneToMany(mappedBy: 'universe', targetEntity: UniverseCharacter::class)]
    private PersistentCollection $characters;

    public function getUniverseCode(): string
    {
        return $this->universecode;
    }

    public function getUniverseComment(): string
    {
        return $this->universecomment;
    }

    /**
     * @return PersistentCollection<int, UniverseCharacter>
     */
    public function getCharacters(): PersistentCollection
    {
        return $this->characters;
    }
}