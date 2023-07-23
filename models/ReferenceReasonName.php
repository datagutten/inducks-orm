<?php

namespace datagutten\InducksORM\models;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'inducks_referencereasonname')]
#[ORM\Entity(readOnly: true)]
class ReferenceReasonName
{
    public function __construct(
        #[ORM\Id, ORM\Column(type: Types::STRING)]
        private string $referencereasonid,
        #[ORM\Id, ORM\Column(type: Types::STRING)]
        private string $languagecode,
    )
    {
    }

    #[ORM\ManyToOne(targetEntity: ReferenceReason::class)]
    #[ORM\JoinColumn(name: 'referencereasonid', referencedColumnName: 'referencereasonid')]
    private ReferenceReason $reason;

    #[ORM\ManyToOne(targetEntity: Language::class)]
    #[ORM\JoinColumn(name: 'languagecode', referencedColumnName: 'languagecode')]
    private Language $language;

    #[ORM\Column(type: 'string')]
    private string $referencereasontranslation;

    /**
     * @return ReferenceReason
     */
    public function getReason(): ReferenceReason
    {
        return $this->reason;
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getReferenceReasonTranslation(): string
    {
        return $this->referencereasontranslation;
    }
}