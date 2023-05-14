<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Exception;


#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'inducks_issue')]
class Issue
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private string $issuecode;

    #[ORM\ManyToOne(targetEntity: Publication::class, inversedBy: 'issues')]
    #[ORM\JoinColumn(name: 'publicationcode', referencedColumnName: 'publicationcode')]
    private Publication $publication;

    #[ORM\Column(type: 'string')]
    private string $issuenumber;

    #[ORM\Column(type: 'string')]
    private string $title;

    #[ORM\Column(type: 'string')]
    private string $size;

    #[ORM\Column(type: 'string')]
    private string $pages;

    #[ORM\Column(type: 'string')]
    private string $price;

    #[ORM\Column(type: 'string')]
    private string $printrun;

    #[ORM\Column(type: 'string')]
    private string $attached;

    #[ORM\Column(type: 'string')]
    private string $oldestdate;

    #[ORM\Column(type: 'string')]
    private string $issuecomment;

    /**
     * @var PersistentCollection<int, IssueURL>
     */
    #[ORM\OneToMany(mappedBy: 'issue', targetEntity: IssueUrl::class)]
    private PersistentCollection $urls;

    /**
     * @var PersistentCollection<int, Entry>
     */
    #[ORM\OneToMany(mappedBy: 'issue', targetEntity: Entry::class)]
    #[ORM\OrderBy(['position' => 'ASC'])]
    private PersistentCollection $entries;

    function getIssuecode(): string
    {
        return $this->issuecode;
    }

    function getPublication(): Publication
    {
        return $this->publication;
    }

    function getIssuenumber(): string
    {
        return $this->issuenumber;
    }

    function getTitle(): string
    {
        if (empty($this->title))
            return sprintf('%s %s', $this->publication->getTitle(), $this->getIssuenumber());
        else
            return $this->title;
    }

    function getSize(): string
    {
        return $this->size;
    }

    function getPages(): string
    {
        return $this->pages;
    }

    function getPrice(): string
    {
        return $this->price;
    }

    function getPrintrun(): string
    {
        return $this->printrun;
    }

    function getAttached(): string
    {
        return $this->attached;
    }

    function getOldestdate(): string
    {
        return $this->oldestdate;
    }

    function getIssuecomment(): string
    {
        return $this->issuecomment;
    }

    /**
     * @return PersistentCollection<int, Entry>
     */
    function getEntries(): PersistentCollection
    {
        return $this->entries;
    }

    public function getThumbnailUrl(): string
    {
        if ($this->urls->count() > 0)
        {
            return $this->urls->first()->generateUrl();
        }
        if ($this->entries->count() > 0)
        {
            return $this->entries->first()->getThumbnailUrl();
        }
        throw new EntityNotFoundException('Thumbnail URL not found');
    }

    /**
     * @return Story[]
     * @throws Exception
     */
    public function getStories(): array
    {
        $stories = [];
        /** @var Entry $entry */
        foreach ($this->entries->getIterator() as $entry)
        {
            try
            {
                $stories[] = $entry->getStoryversion()->getStory();
            }
            catch (EntityNotFoundException)
            {
                continue;
            }
        }
        return $stories;
    }

    public function getURL(): string
    {
        return sprintf('https://inducks.org/issue.php?c=%s', urlencode($this->issuecode));
    }
}
