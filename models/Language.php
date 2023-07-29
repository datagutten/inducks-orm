<?php

namespace datagutten\InducksORM\models;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;


#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'inducks_language')]
class Language
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private string $languagecode;

    #[ORM\Column(type: 'string')]
    private string $defaultlanguagecode;

    #[ORM\Column(type: 'string')]
    private string $languagename;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: Publication::class)]
    private PersistentCollection $publications;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: CharacterName::class)]
    private PersistentCollection $characterNames;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: LanguageName::class)]
    private PersistentCollection $names;

    public function getCode(): string
    {
        return $this->languagecode;
    }

    public function getDefaultLanguageCode(): string
    {
        return $this->defaultlanguagecode;
    }

    public function getName(): string
    {
        return $this->languagename;
    }

    /**
     * Get publications in the current language
     * @return PersistentCollection
     */
    public function getPublications(): PersistentCollection
    {
        return $this->publications;
    }

    /**
     * Get character names in the current language
     * @return PersistentCollection
     */
    public function getCharacterNames(): PersistentCollection
    {
        return $this->characterNames;
    }

    public function __toString(): string
    {
        return $this->languagename;
    }

    public function getNames(): PersistentCollection
    {
        return $this->names;
    }

    public function getLocalizedName($languageCode): string
    {
        $names = $this->names->matching(Criteria::create()->where(Criteria::expr()->eq('languagecode', $languageCode)));
        return $names->first()->getLanguageName();
    }
}