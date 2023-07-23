<?php

namespace datagutten\InducksORM\models;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;


#[ORM\Table(name: 'inducks_referencereason')]
#[ORM\Entity(readOnly: true)]
class ReferenceReason
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    private int $referencereasonid;

    #[ORM\Column(type: 'string')]
    private string $referencereasontext;

    #[ORM\OneToMany(mappedBy: 'reason', targetEntity: ReferenceReasonName::class)]
    private PersistentCollection $names;

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

    /**
     * @return PersistentCollection<int, ReferenceReasonName>
     */
    public function getNames(): PersistentCollection
    {
        return $this->names;
    }

    public function getLocalizedName($languageCode): string
    {
        $names = $this->names->matching(Criteria::create()->where(Criteria::expr()->eq('languagecode', $languageCode)));
        return $names->first()->getReferenceReasonTranslation();
    }

    public function __toString(): string
    {
        return $this->referencereasontext;
    }
}