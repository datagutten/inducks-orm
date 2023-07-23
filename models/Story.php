<?php

namespace datagutten\InducksORM\models;

use DateTimeImmutable;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Exception;

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

    #[ORM\OneToMany(mappedBy: 'fromStory', targetEntity: StoryReference::class)]
    private PersistentCollection $referencesFrom;

    #[ORM\OneToMany(mappedBy: 'toStory', targetEntity: StoryReference::class)]
    private PersistentCollection $referencesTo;

    function getStorycode(): string
    {
        return $this->storycode;
    }

    /**
     * @return StoryVersion The original storyversion
     */
    function getOriginalstoryversion(): StoryVersion
    {
        return $this->originalstoryversion;
    }

    /**
     * @return string The date that the story was actually made. Usually we only know an approximate date, if any.
     */
    function getCreationdate(): string
    {
        return $this->creationdate;
    }

    /**
     * @return string The date that the story was first published
     */
    function getFirstpublicationdate(): string
    {
        return $this->firstpublicationdate;
    }

    /**
     * Get the date that the story was first published as a DateTimeImmutable object
     * @return DateTimeImmutable The date that the story was first published
     * @throws Exception
     */
    function getFirstPublicationDate_obj(): DateTimeImmutable
    {
        try
        {
            return new DateTimeImmutable($this->firstpublicationdate);
        }
        catch (Exception $e)
        {
            $year = preg_replace('#(\d{4})-Q\d#', '$1', $this->firstpublicationdate);
            if ($year != $this->firstpublicationdate) //Pattern matched and did a replacement
                return new DateTimeImmutable($year);
            else //No match, re-throw the exception
                throw $e;
        }
    }

    /**
     * @return string The end date that the story was first published (in case of newspaper strips). Only filled in if a newspaper strip was printed over more than one day
     */
    function getEndpublicationdate(): string
    {
        return $this->endpublicationdate;
    }

    /**
     * @return string The original title of the story, given by the writer, artist, or editor
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

    /**
     * @return int The number of parts the story was designed in (this can usually be seen from the recap panels)
     */
    function getStoryparts(): int
    {
        return $this->storyparts;
    }

    /**
     * @return Issue The issuecode where this item is defined in the input (if empty: story file)
     */
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

    /**
     * References from this story
     * @return PersistentCollection
     */
    public function getReferencesFrom(): PersistentCollection
    {
        return $this->referencesFrom;
    }

    /**
     * References to this story
     * @return PersistentCollection
     */
    public function getReferencesTo(): PersistentCollection
    {
        return $this->referencesTo;
    }
}
