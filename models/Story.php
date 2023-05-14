<?php

namespace datagutten\InducksORM\models;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Story
 *
 *
 * @author dromanin
 */
#[ORM\Table(name: 'inducks_story')]
#[ORM\Entity(readOnly: true)]
class Story
{
    #[ORM\Column(type: 'string')]
    #[ORM\Id]
    private string $storycode;

    #[ORM\ManyToOne(targetEntity: StoryVersion::class)]
    #[ORM\JoinColumn(name: 'originalstoryversioncode', referencedColumnName: 'storyversioncode')]
    private StoryVersion $originalstoryversion;

    #[ORM\Column(type: 'string')]
    private string $creationdate;

    #[ORM\Column(type: 'string')]
    private string $firstpublicationdate;

    #[ORM\Column(type: 'string')]
    private string $endpublicationdate;

    #[ORM\Column(type: 'string')]
    private string $title;

    #[ORM\Column(type: 'string')]
    private string $storycomment;

    #[ORM\Column(type: 'integer')]
    private int $storyparts;

    #[ORM\ManyToOne(targetEntity: Issue::class)]
    #[ORM\JoinColumn(name: 'issuecodeofstoryitem', referencedColumnName: 'issuecode')]
    private Issue $issueofstoryitem;

    #[ORM\OneToMany(mappedBy: 'story', targetEntity: StoryVersion::class)]
    private PersistentCollection $versions;

    #[ORM\OneToOne(mappedBy: 'storycode', targetEntity: HeroCharacter::class)]
    #[ORM\JoinColumn(name: 'storycode', referencedColumnName: 'storycode')]
    private HeroCharacter $hero;

    function getStorycode(): string
    {
        return $this->storycode;
    }

    function getOriginalstoryversion(): StoryVersion
    {
        return $this->originalstoryversion;
    }

    function getCreationdate(): string
    {
        return $this->creationdate;
    }

    function getFirstpublicationdate(): string
    {
        return $this->firstpublicationdate;
    }

    function getEndpublicationdate(): string
    {
        return $this->endpublicationdate;
    }

    /**
     * @return string Story original title
     */
    function getTitle(): string
    {
        return $this->title;
    }

    function getLocalizedTitle(string $languagecode): string
    {
        /** @var StoryVersion $version */
        $version = $this->versions->first();

        $criteria = Criteria::create()->where(
            Criteria::expr()->eq('languagecode', $languagecode))->andWhere(
            Criteria::expr()->eq('reallytitle', 'Y'));
        return $version->getEntries($criteria)->first()->getTitle();
    }

    function getStorycomment(): string
    {
        return $this->storycomment;
    }

    function getStoryparts(): int
    {
        return $this->storyparts;
    }

    function getIssueofstoryitem(): Issue
    {
        return $this->issueofstoryitem;
    }

    public function getVersions(): PersistentCollection
    {
        return $this->versions;
    }

    public function getHero(): Character
    {
        return $this->hero->getCharacter();
    }
}
