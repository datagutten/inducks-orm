<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;


/**
 * EntryUrl
 *
 *
 * @author dromanin
 */
#[ORM\Table(name: 'inducks_entryurl')]
#[ORM\Entity(readOnly: true)]
class EntryUrl
{
    #[ORM\Column]
    private string $entrycode;

    #[ORM\ManyToOne(targetEntity: Entry::class, inversedBy: 'urls')]
    #[ORM\JoinColumn(name: 'entrycode', referencedColumnName: 'entrycode')]
    #[ORM\Id]
    private Entry $entry;

    #[ORM\Column]
    private string $sitecode;

    #[ORM\ManyToOne(targetEntity: Site::class)]
    #[ORM\JoinColumn(name: 'sitecode', referencedColumnName: 'sitecode')]
    #[ORM\Id]
    private Site $site;

    #[ORM\Column]
    #[ORM\Id]
    private string $url;

    #[ORM\Column]
    #[ORM\Id]
    private int $pagenumber;

    #[ORM\Column]
    private string $storycode;

    #[ORM\ManyToOne(targetEntity: Story::class, inversedBy: 'urls')]
    #[ORM\JoinColumn(name: 'storycode', referencedColumnName: 'storycode')]
    #[ORM\Id]
    private Story $story;

    #[ORM\Column]
    private string $public;

    public function generateUrl(): string
    {
        return $this->site->getURLBase() . $this->url;
    }

    public function getEntryCode(): string
    {
        return $this->entrycode;
    }

    /**
     * Get entry object
     * @return Entry
     */
    public function getEntry(): Entry
    {
        return $this->entry;
    }

    public function getSiteCode(): string
    {
        return $this->sitecode;
    }

    /**
     * Get site object
     * @return Site
     */
    public function getSite(): Site
    {
        return $this->site;
    }

    public function getPageNumber(): int
    {
        return $this->pagenumber;
    }

    /**
     * Get relative URL
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    public function getStoryCode(): string
    {
        return $this->storycode;
    }

    /**
     * Get story object
     * @return Story
     */
    public function getStory(): Story
    {
        return $this->story;
    }

    public function isPublic(): bool
    {
        return $this->public == 'Y';
    }

}
