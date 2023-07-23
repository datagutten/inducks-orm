<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'inducks_publication')]
class Publication
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private string $publicationcode;

    #[ORM\Column(type: 'string')]
    private string $countrycode;

    #[ORM\Column(type: 'string')]
    private string $languagecode;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'publications')]
    #[ORM\JoinColumn(name: 'languagecode', referencedColumnName: 'languagecode')]
    private Language $language;

    #[ORM\Column(type: 'string')]
    private string $title;

    #[ORM\Column(type: 'string')]
    private string $size;

    #[ORM\Column(type: 'string')]
    private string $publicationcomment;

    /**
     * @var PersistentCollection<int, Issue>
     */
    #[ORM\OneToMany(mappedBy: 'publication', targetEntity: Issue::class)]
    private PersistentCollection $issues;

    /**
     * @var PersistentCollection<int, PublicationName>
     */
    #[ORM\OneToMany(mappedBy: 'publicationcode', targetEntity: PublicationName::class)]
    private PersistentCollection $names;

    /**
     * @var PersistentCollection<int, PublicationCategory>
     */
    #[ORM\OneToMany(mappedBy: 'publicationcode', targetEntity: PublicationCategory::class)]
    private PersistentCollection $categories;

    function getPublicationcode(): string
    {
        return $this->publicationcode;
    }

    function getCountrycode(): string
    {
        return $this->countrycode;
    }

    function getLanguagecode(): string
    {
        return $this->languagecode;
    }

    function getLanguage(): Language
    {
        return $this->language;
    }

    function getTitle(): string
    {
        return $this->title;
    }

    function getSize(): string
    {
        return $this->size;
    }

    function getPublicationcomment(): string
    {
        return $this->publicationcomment;
    }

    /**
     * @return PersistentCollection<int, PublicationName>
     */
    function getNames(): PersistentCollection
    {
        return $this->names;
    }

    /**
     * @return PersistentCollection<int, PublicationCategory>
     */
    function getCategories(): PersistentCollection
    {
        return $this->categories;
    }

    /**
     * @return PersistentCollection<int, Issue>
     */
    function getIssues(): PersistentCollection
    {
        return $this->issues;
    }

}
