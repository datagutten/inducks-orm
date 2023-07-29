<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'inducks_languagename')]
class LanguageName
{
    function __construct(
        #[ORM\Id, ORM\Column(type: 'string')]
        private string $desclanguagecode,
        #[ORM\Id, ORM\Column(type: 'string')]
        private string $languagecode,
    )
    {
    }

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'names')]
    #[ORM\JoinColumn(name: 'languagecode', referencedColumnName: 'languagecode')]
    private Language $language;

    #[ORM\Column(type: 'string')]
    private string $languagename;

    public function getDesLanguageCode(): string
    {
        return $this->desclanguagecode;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function getLanguageCode(): string
    {
        return $this->languagecode;
    }

    public function getLanguageName(): string
    {
        return $this->languagename;
    }
}