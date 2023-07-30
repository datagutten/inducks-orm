<?php

namespace datagutten\InducksORM\models;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;


#[ORM\Table(name: 'inducks_country')]
#[ORM\Entity(readOnly: true)]
class Country
{
    #[ORM\Column(type: 'string')]
    #[ORM\Id]
    private string $countrycode;

    #[ORM\Column(type: 'string')]
    private string $countryname;

    #[ORM\ManyToOne(targetEntity: Language::class)]
    #[ORM\JoinColumn(name: 'defaultlanguage', referencedColumnName: 'languagecode')]
    private Language $defaultlanguage;

    #[ORM\Column(type: 'string')] //TODO: Add relation to inducks_team
    private string $defaultmaintenanceteam;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Publication::class)]
    private PersistentCollection $publications;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: CountryName::class)]
    private PersistentCollection $names;

    public function getCountryCode(): string
    {
        return $this->countrycode;
    }

    public function getCountryName(): string
    {
        return $this->countryname;
    }

    public function getLanguage(): Language
    {
        return $this->defaultlanguage;
    }

    public function getMaintenanceTeam(): string
    {
        return $this->defaultmaintenanceteam;
    }

    public function getPublications(): PersistentCollection
    {
        return $this->publications;
    }

    /**
     * Get localized language name
     * @param string $languageCode
     * @return string
     * @throws EntityNotFoundException
     */
    public function getLocalizedName(string $languageCode): string
    {
        $names = $this->names->matching(Criteria::create()->where(Criteria::expr()->eq('languagecode', $languageCode)));
        if ($names->count() == 0)
            throw new EntityNotFoundException('Localization not found');
        return $names->first()->getCountryName();
    }

    public function __toString(): string
    {
        return $this->countryname;
    }
}