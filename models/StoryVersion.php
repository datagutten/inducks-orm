<?php

namespace datagutten\InducksORM\models;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;


/**
 * StoryVersion
 *
 *
 * @author dromanin
 */
#[ORM\Table(name: 'inducks_storyversion')]
#[ORM\Entity(readOnly: true)]
class StoryVersion
{
    #[ORM\Column(type: 'string')]
    #[ORM\Id]
    private string $storyversioncode;

    #[ORM\Column(type: 'string')]
    private string $storycode;

    #[ORM\ManyToOne(targetEntity: Story::class, inversedBy: 'versions')]
    #[ORM\JoinColumn(name: 'storycode', referencedColumnName: 'storycode')]
    private Story $story;

    #[ORM\OneToMany(mappedBy: 'storyversion', targetEntity: Entry::class)]
    private PersistentCollection $entries;

    #[ORM\OneToMany(mappedBy: 'storyversion', targetEntity: StoryJob::class)]
    private PersistentCollection $jobs;

    #[ORM\OneToMany(mappedBy: 'storyversion', targetEntity: Appearance::class)]
    private PersistentCollection $appearances;

    #[ORM\Column(type: 'integer')]
    private int $entirepages;

    #[ORM\Column(type: 'integer')]
    private int $brokenpagenumerator;

    #[ORM\Column(type: 'integer')]
    private int $brokenpagedenominator;

    #[ORM\Column(type: 'string')]
    private string $brokenpageunspecified;

    // i=illustration c=cover, n=normal, a=article
    // n = normal, k = newspaper strip, c = cover, i = illustration, a = article, P = painting
    // f = ??
    // g = ??
    // t = ??
    // L = ??
    #[ORM\Column(type: 'string')]
    private string $kind;

    #[ORM\Column(type: 'integer')]
    private int $rowsperpage;

    #[ORM\Column(type: 'integer')]
    private int $columnsperpage;

    function getStoryversioncode(): string
    {
        return $this->storyversioncode;
    }

    function getStoryCode(): string
    {
        return $this->storycode;
    }

    function getStory(): Story
    {
        if (!empty($this->storycode))
            return $this->story;
        else
            throw new EntityNotFoundException('Storyversion has no storycode');
    }

    function getEntirepages(): int
    {
        return $this->entirepages;
    }

    function getBrokenpagenumerator(): int
    {
        return $this->brokenpagenumerator;
    }

    function getBrokenpagedenominator(): int
    {
        return $this->brokenpagedenominator;
    }

    function getBrokenpageunspecified(): string
    {
        return $this->brokenpageunspecified;
    }

    function getKind(): string
    {
        return $this->kind;
    }

    function getKindName(): string
    {
        return match ($this->kind)
        {
            'n' => 'normal',
            'k' => 'newspaper strip',
            'i' => 'illustration',
            'c' => 'cover',
            'f' => 'centerfold',
            't' => 'text',
            'a' => 'article',
            'g' => 'game or puzzle',
            's' => 'strange layout',
            'L' => 'landscape painting',
            'P' => 'portrait painting',
            default => $this->kind,
        };
    }

    function getRowsperpage(): int
    {
        return $this->rowsperpage;
    }

    function getColumnsperpage(): int
    {
        return $this->columnsperpage;
    }

    /**
     * @param Criteria|null $filter
     * @return Collection<int, Entry>|PersistentCollection<int, Entry>
     */
    public function getEntries(Criteria $filter = null): Collection|PersistentCollection
    {
        if (!empty($filter))
            return $this->entries->matching($filter);
        else
            return $this->entries;
    }

    /**
     * @return PersistentCollection<int, StoryJob>
     */
    public function getJobs(): PersistentCollection
    {
        return $this->jobs;
    }

    /**
     * @return PersistentCollection<int, Appearance>
     */
    public function getAppearances(): PersistentCollection
    {
        return $this->appearances;
    }

    public function isCover(): bool
    {
        return $this->kind == 'c';
    }

    public function isGag(): bool
    {
        return $this->kind == 'n' && $this->entirepages <= 1 && $this->entirepages >= 0;
    }

    public function isArticle(): bool
    {
        return $this->kind == 'a';
    }

    public function isIllustration(): bool
    {
        //i=illustration 
        //P=painting
        return $this->kind == 'i' || $this->kind == 'P';
    }

    public function isUnknown(): bool
    {
        return in_array($this->kind, ['f', 'g', 't', 'L']);
    }
}
