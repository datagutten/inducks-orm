<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'inducks_countryname')]
#[ORM\Entity(readOnly: true)]
class CountryName
{
    function __construct(
        #[ORM\Id, ORM\Column]
        private string $countrycode,
        #[ORM\Id, ORM\Column]
        private string $languagecode,
    )
    {
    }

    #[ORM\ManyToOne(targetEntity: Country::class)]
    #[ORM\JoinColumn(name: 'countrycode', referencedColumnName: 'countrycode')]
    private Country $country;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'names')]
    #[ORM\JoinColumn(name: 'languagecode', referencedColumnName: 'languagecode')]
    private Language $language;

    #[ORM\Column]
    private string $countryname;

    public function getCountryCode(): string
    {
        return $this->countrycode;
    }

    public function getLanguageCode(): string
    {
        return $this->languagecode;
    }

    public function getCountryName(): string
    {
        return $this->countryname;
    }
}