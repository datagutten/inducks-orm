<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * IssueUrl
 *
 *
 * @author dromanin
 */
#[ORM\Table(name: 'inducks_issueurl')]
#[ORM\Entity(readOnly: true)]
class IssueUrl
{
    #[ORM\ManyToOne(targetEntity: Issue::class, inversedBy: 'urls')]
    #[ORM\JoinColumn(name: 'issuecode', referencedColumnName: 'issuecode')]
    #[ORM\Id]
    private Issue $issue;

    #[ORM\ManyToOne(targetEntity: Site::class)]
    #[ORM\JoinColumn(name: 'sitecode', referencedColumnName: 'sitecode')]
    #[ORM\Id]
    private Site $site;

    #[ORM\Column]
    #[ORM\Id]
    private string $url;

    public function generateUrl(): string
    {
        return $this->site->getURLBase() . $this->url;
    }
}
