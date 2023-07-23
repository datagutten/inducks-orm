<?php

namespace datagutten\InducksORM\models;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'inducks_publishingjob')]
class PublishingJob
{
    public function __construct(
        #[ORM\Id, ORM\Column(type: Types::STRING)]
        private string $publisherid,
        #[ORM\Id, ORM\Column(type: Types::STRING)]
        private string $issuecode,
    )
    {
    }

    #[ORM\ManyToOne(targetEntity: Publisher::class, inversedBy: 'jobs')]
    #[ORM\JoinColumn(name: 'publisherid', referencedColumnName: 'publisherid')]
    private Publisher $publisher;

    #[ORM\ManyToOne(targetEntity: Issue::class, inversedBy: 'publishingjobs')]
    #[ORM\JoinColumn(name: 'issuecode', referencedColumnName: 'issuecode')]
    private Issue $issue;

    #[ORM\Column(type: 'string')]
    private string $publishingjobcomment;

    public function getPublisherId(): string
    {
        return $this->publisherid;
    }

    public function getPublisher(): Publisher
    {
        return $this->publisher;
    }

    public function getIssueCode(): string
    {
        return $this->issuecode;
    }

    public function getIssue(): Issue
    {
        return $this->issue;
    }

    public function getComment(): string
    {
        return $this->publishingjobcomment;
    }

    public function __toString(): string
    {
        return $this->getPublisher()->getName();
    }
}