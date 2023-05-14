<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;


/**
 * HeroCharacter
 *
 * @author datagutten
 */
#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'inducks_herocharacter')]
class HeroCharacter
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private string $storycode;

    #[ORM\Column(type: 'string')]
    private string $charactercode;

    #[ORM\ManyToOne(targetEntity: Story::class, inversedBy: 'hero')]
    #[ORM\JoinColumn(name: 'storycode', referencedColumnName: 'storycode')]
    private Story $story;

    #[ORM\ManyToOne(targetEntity: Character::class)]
    #[ORM\JoinColumn(name: 'charactercode', referencedColumnName: 'charactercode')]
    public Character $character;

    #[ORM\Column(type: 'string')]
    private string $doubt;

    #[ORM\Column(type: 'integer')]
    private int $number;

    function getCharacterCode(): string
    {
        return $this->charactercode;
    }

    function getCharacterName(): string
    {
        return $this->getCharacter()->getCharactername();
    }

    function getCharacter(): Character
    {
        return $this->character;
    }

    public function getStory(): Story
    {
        return $this->story;
    }
}
