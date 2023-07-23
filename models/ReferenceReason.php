<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'inducks_referencereason')]
#[ORM\Entity(readOnly: true)]
class ReferenceReason
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    private int $referencereasonid;

    #[ORM\Column(type: 'string')]
    private string $referencereasontext;

    /**
     * @return int
     */
    public function getReferenceReasonId(): int
    {
        return $this->referencereasonid;
    }

    /**
     * @return string
     */
    public function getReferenceReasonText(): string
    {
        return $this->referencereasontext;
    }

    public function __toString(): string
    {
        return $this->referencereasontext;
    }
}