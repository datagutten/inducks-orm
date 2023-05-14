<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Entry
 *
 *
 * @author dromanin
 */
#[ORM\Table(name: 'inducks_entry')]
#[ORM\Entity(readOnly: true)]
class Entry
{
    #[ORM\Column(type: 'string')]
    #[ORM\Id]
    private string $entrycode;

    #[ORM\ManyToOne(targetEntity: Issue::class, inversedBy: 'entries')]
    #[ORM\JoinColumn(name: 'issuecode', referencedColumnName: 'issuecode')]
    private Issue $issue;

    #[ORM\ManyToOne(targetEntity: StoryVersion::class, inversedBy: 'entries')]
    #[ORM\JoinColumn(name: 'storyversioncode', referencedColumnName: 'storyversioncode')]
    private StoryVersion $storyversion;

    /**
     * @var PersistentCollection<int, EntryUrl>
     */
    #[ORM\OneToMany(mappedBy: 'entry', targetEntity: EntryUrl::class)]
    #[ORM\OrderBy(['pagenumber' => 'ASC'])]
    private PersistentCollection $urls;

    /**
     * @var PersistentCollection<int, EntryJob>
     */
    #[ORM\OneToMany(mappedBy: 'entry', targetEntity: EntryJob::class)]
    private PersistentCollection $jobs;

    #[ORM\Column(type: 'string')]
    private string $languagecode;

    #[ORM\Column(type: 'string')]
    private string $includedinentrycode;

    #[ORM\Column(type: 'string')]
    private string $position;

    #[ORM\Column(type: 'string')]
    private string $printedcode;

    #[ORM\Column(type: 'string')]
    private string $guessedcode;

    #[ORM\Column(type: 'string')]
    private string $title;

    #[ORM\Column(type: 'string')]
    private string $reallytitle;

    #[ORM\Column(type: 'string')]
    private string $printedhero;

    #[ORM\Column(type: 'string')]
    private string $changes;

    #[ORM\Column(type: 'string')]
    private string $cut;

    #[ORM\Column(type: 'string')]
    private string $minorchanges;

    #[ORM\Column(type: 'string')]
    private string $missingpanels;

    #[ORM\Column(type: 'string')]
    private string $mirrored;

    #[ORM\Column(type: 'string')]
    private string $sideways;

    #[ORM\Column(type: 'string')]
    private string $startdate;

    #[ORM\Column(type: 'string')]
    private string $enddate;

    #[ORM\Column(type: 'string')]
    private string $part;

    #[ORM\Column(type: 'string')]
    private string $entrycomment;

    function getEntrycode(): string
    {
        return $this->entrycode;
    }

    function getIssue(): Issue
    {
        return $this->issue;
    }

    function getStoryversion(): StoryVersion
    {
        return $this->storyversion;
    }

    function getLanguagecode(): string
    {
        return $this->languagecode;
    }

    function getIncludedinentrycode(): string
    {
        return $this->includedinentrycode;
    }

    function getPosition(): string
    {
        return $this->position;
    }

    function getPrintedcode(): string
    {
        return $this->printedcode;
    }

    function getGuessedcode(): string
    {
        return $this->guessedcode;
    }

    function getTitle(): string
    {
        return $this->title;
    }

    function getReallytitle(): bool
    {
        return $this->reallytitle == 'Y';
    }

    function getPrintedhero(): string
    {
        return $this->printedhero;
    }

    function getChanges(): string
    {
        return $this->changes;
    }

    function getCut(): string
    {
        return $this->cut;
    }

    function getMinorchanges(): string
    {
        return $this->minorchanges;
    }

    function getMissingpanels(): string
    {
        return $this->missingpanels;
    }

    function getMirrored(): string
    {
        return $this->mirrored;
    }

    function getSideways(): string
    {
        return $this->sideways;
    }

    function getStartdate(): string
    {
        return $this->startdate;
    }

    function getEnddate(): string
    {
        return $this->enddate;
    }

    function getPart(): string
    {
        return $this->part;
    }

    function getEntrycomment(): string
    {
        return $this->entrycomment;
    }

    /**
     * @return PersistentCollection<int, EntryUrl>
     */
    public function getUrls(): PersistentCollection
    {
        return $this->urls;
    }

    /**
     * @return PersistentCollection<int, EntryJob>
     */
    public function getJobs(): PersistentCollection
    {
        return $this->jobs;
    }

    public function getThumbnailUrl(): string
    {
        if ($this->urls->count() > 0)
            return $this->urls->first()->generateUrl();

        throw new EntityNotFoundException('Thumbnail URL not found');
    }
}
