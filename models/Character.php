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

    #[ORM\Column(type: 'string')]
    private string $official;

    #[ORM\Column(type: 'string')]
    private string $onetime;

    #[ORM\Column(type: 'string')]
    private string $heroonly;

    #[ORM\Column(type: 'string')]
    private string $charactercomment;


    /**
     * @var PersistentCollection<int, CharacterName>
     */
    #[ORM\OneToMany(mappedBy: 'character', targetEntity: CharacterName::class)]
    private PersistentCollection $names;

    /**
     * @var PersistentCollection<int, EntryCharacterName>
     */
    #[ORM\OneToMany(mappedBy: 'character', targetEntity: EntryCharacterName::class)]
    private PersistentCollection $entryNames;

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

    public function getOfficial(): bool
    {
        return $this->official == 'Y';
    }

    public function getOnetime(): bool
    {
        return $this->onetime == 'Y';
    }

    public function getHeroOnly(): bool
    {
        return $this->heroonly == 'Y';
    }

    public function getCharacterComment(): string
    {
        return $this->charactercomment;
    }

    public function getEntryNames(): PersistentCollection
    {
        return $this->entryNames;
    }
}
