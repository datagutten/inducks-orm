<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;

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

    public function __toString(): string
    {
        return $this->languagename;
    }
}