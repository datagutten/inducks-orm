<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'inducks_publicationname')]
#[ORM\Entity(readOnly: true)]
class PublicationName
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Publication::class, inversedBy: 'names')]
    #[ORM\JoinColumn(name: 'publicationcode', referencedColumnName: 'publicationcode')]
    private Publication $publicationcode;

    #[ORM\Column]
    #[ORM\Id]
    private string $publicationname;

    public function getPublicationcode(): Publication
    {
        return $this->publicationcode;
    }

    public function getPublicationname(): string
    {
        return $this->publicationname;
    }
}
