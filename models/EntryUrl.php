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
    #[ORM\ManyToOne(targetEntity: Entry::class, inversedBy: 'urls')]
    #[ORM\JoinColumn(name: 'entrycode', referencedColumnName: 'entrycode')]
    #[ORM\Id]
    private Entry $entry;

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

    public function generateUrl(): string
    {
        return $this->site->getURLBase() . $this->url;
    }

}
