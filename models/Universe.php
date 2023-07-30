<?php

namespace datagutten\InducksORM\models;

use Doctrine\Common\Collections\Criteria;
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

    #[ORM\OneToMany(mappedBy: 'universe', targetEntity: UniverseName::class)]
    private PersistentCollection $names;

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

    /**
     * @return PersistentCollection<int, UniverseName>
     */
    public function getNames(): PersistentCollection
    {
        return $this->names;
    }

    public function getLocalizedName($languageCode): ?string
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq('languagecode', $languageCode));
        $matches = $this->names->matching($criteria);
        if (!empty($matches->count()))
            return $matches->first()->getUniverseName();
        else
            return null;
    }

    public function __toString()
    {
        return $this->universecode;
    }
}