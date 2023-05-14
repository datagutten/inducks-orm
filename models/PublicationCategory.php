<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'inducks_publicationcategory')]
#[ORM\Entity(readOnly: true)]
class PublicationCategory
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Publication::class, inversedBy: 'categories')]
    #[ORM\JoinColumn(name: 'publicationcode', referencedColumnName: 'publicationcode')]
    private Publication $publicationcode;

    #[ORM\Column(type: 'string')]
    #[ORM\Id]
    private string $category;

    public function getPublicationcode(): Publication
    {
        return $this->publicationcode;
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}
