<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;


/**
 * IssueCollecting
 * Issues collecting other issues
 *
 * @author datagutten
 */
#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'inducks_issuecollecting')]
class IssueCollecting
{
    function __construct(#[ORM\Id, ORM\Column(type: 'string')]
                         private string $collectingissuecode,
                         #[ORM\Id, ORM\Column(type: 'string')]
                         private string $collectedissuecode)
    {
    }

    #[ORM\ManyToOne(targetEntity: Issue::class, inversedBy: 'collected')]
    #[ORM\JoinColumn(name: 'collectedissuecode', referencedColumnName: 'issuecode')]
    public Issue $collected;

    #[ORM\ManyToOne(targetEntity: Issue::class, inversedBy: 'collecting')]
    #[ORM\JoinColumn(name: 'collectingissuecode', referencedColumnName: 'issuecode')]
    public Issue $collecting;

    public function getCollectingIssueCode(): string
    {
        return $this->collectingissuecode;
    }

    public function getCollectedIssueCode(): string
    {
        return $this->collectedissuecode;
    }

    /**
     * Collected issue
     * @return Issue
     */
    public function getCollected(): Issue
    {
        return $this->collected;
    }

    /**
     * Collecting issue
     * @return Issue
     */
    public function getCollecting(): Issue
    {
        return $this->collecting;
    }

}