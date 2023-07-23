<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'inducks_publisher')]
class Publisher
{
    #[ORM\Column(type: 'string')]
    #[ORM\Id]
    private string $publisherid;

    #[ORM\Column(type: 'string')]
    private string $publishername;

    #[ORM\OneToMany(mappedBy: 'publisher', targetEntity: PublishingJob::class)]
    private PersistentCollection $jobs;

    public function getId(): string
    {
        return $this->publisherid;
    }

    public function getName(): string
    {
        return $this->publishername;
    }

    public function getJobs(): PersistentCollection
    {
        return $this->jobs;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}