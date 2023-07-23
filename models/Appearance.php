<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appearance
 *
 *
 * @author dromanin
 */
#[ORM\Table(name: 'inducks_appearance')]
#[ORM\Entity(readOnly: true)]
class Appearance
{
    #[ORM\ManyToOne(targetEntity: StoryVersion::class, inversedBy: 'appearances')]
    #[ORM\JoinColumn(name: 'storyversioncode', referencedColumnName: 'storyversioncode')]
    #[ORM\Id]
    private StoryVersion $storyversion;

    #[ORM\ManyToOne(targetEntity: Character::class)]
    #[ORM\JoinColumn(name: 'charactercode', referencedColumnName: 'charactercode')]
    #[ORM\Id]
    private Character $character;

    #[ORM\Column(type: 'integer')]
    #[ORM\Id]
    private int $number;

    #[ORM\Column(type: 'string')]
    private string $appearancecomment;

    function getStoryversion(): StoryVersion
    {
        return $this->storyversion;
    }

    function getCharacter(): Character
    {
        return $this->character;
    }

    /**
     * @return int The actual number of characters, in case of e.g. the Beagle Boys
     */
    function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return string Remarks about the appearance, like 'cameo', '1st', 'photo'.
     */
    function getAppearancecomment(): string
    {
        return $this->appearancecomment;
    }
}
