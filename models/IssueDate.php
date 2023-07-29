<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;


/**
 * IssueDate
 *
 * @author datagutten
 */
#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'inducks_issuedate')]
class IssueDate
{
    function __construct(#[ORM\Id, ORM\Column(type: 'string')]
                         private string $issuecode,
                         #[ORM\Id, ORM\Column(type: 'string')]
                         private string $date)
    {
    }

    #[ORM\ManyToOne(targetEntity: Issue::class, inversedBy: 'dates')]
    #[ORM\JoinColumn(name: 'issuecode', referencedColumnName: 'issuecode')]
    private Issue $issue;

    #[ORM\Column(type: 'string')]
    private string $kindofdate;

    #[ORM\Column(type: 'string')]
    private string $doubt;

    public function getIssueCode(): string
    {
        return $this->issuecode;
    }

    public function getIssue(): Issue
    {
        return $this->issue;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getYear(): string
    {
        return substr($this->date, 0, 4);
    }

    public function hasDate(): bool
    {
        return strlen($this->date) > 4;
    }

    public function getKindOfDate(): string
    {
        return $this->kindofdate;
    }

    public function getDoubt(): bool
    {
        return $this->doubt == 'Y';
    }

    public function __toString(): string
    {
        return $this->date;
    }
}