<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Character
 *
 *
 * @author dromanin
 */
#[ORM\Table(name: 'inducks_character')]
#[ORM\Entity(readOnly: true)]
class Character
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private string $charactercode;

    #[ORM\Column(type: 'string')]
    private string $charactername;

    /**
     * @var PersistentCollection<int, CharacterName>
     */
    #[ORM\OneToMany(mappedBy: 'character', targetEntity: CharacterName::class)]
    private PersistentCollection $names;

    function getCharactercode(): string
    {
        return $this->charactercode;
    }

    function getCharactername(): string
    {
        return $this->charactername;
    }

    function getNames(): PersistentCollection
    {
        return $this->names;
    }

    function getLocalizedName(string $lang, bool $preferred = true): string
    {
        $preferred = $preferred ? 'Y' : 'N';
        foreach ($this->names as $n)
        {
            if ($lang == $n->getLanguagecode() && $preferred == $n->getPreferred())
            {
                return $n->getCharactername();
            }
        }
        throw new EntityNotFoundException('Localized name not found');
    }
}
