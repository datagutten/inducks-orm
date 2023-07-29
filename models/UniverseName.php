<?php

namespace datagutten\InducksORM\models;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'inducks_universename')]
#[ORM\Entity(readOnly: true)]
class UniverseName
{
    public function __construct(
        #[ORM\Id, ORM\Column(type: Types::STRING)]
        private string $universecode,
        #[ORM\Id, ORM\Column(type: Types::STRING)]
        private string $languagecode,
    )
    {
    }

    #[ORM\ManyToOne(targetEntity: Universe::class, inversedBy: 'names')]
    #[ORM\JoinColumn(name: 'universecode', referencedColumnName: 'universecode')]
    private Universe $universe;

    #[ORM\ManyToOne(targetEntity: Language::class)]
    #[ORM\JoinColumn(name: 'languagecode', referencedColumnName: 'languagecode')]
    private Language $language;

    #[ORM\Column(type: Types::STRING)]
    private string $universename;

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
    public function getUniverseName(): string
    {
        return $this->universename;
    }

    /**
     * @return Universe
     */
    public function getUniverse(): Universe
    {
        return $this->universe;
    }

    public function getLanguageCode(): string
    {
        return $this->languagecode;
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }
}