<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'inducks_storyreference')]
#[ORM\Entity(readOnly: true)]
class StoryReference
{
    public function __construct(
        #[ORM\Id, ORM\Column(type: 'string')]
        private string $fromstorycode,
        #[ORM\Id, ORM\Column(type: 'string')]
        private string $tostorycode
    )
    {
    }

    #[ORM\ManyToOne(targetEntity: Story::class)]
    #[ORM\JoinColumn(name: 'fromstorycode', referencedColumnName: 'storycode')]
    private Story $fromStory;

    #[ORM\ManyToOne(targetEntity: Story::class)]
    #[ORM\JoinColumn(name: 'tostorycode', referencedColumnName: 'storycode')]
    private Story $toStory;

    #[ORM\ManyToOne(targetEntity: ReferenceReason::class)]
    #[ORM\JoinColumn(name: 'referencereasonid', referencedColumnName: 'referencereasonid')]
    private ReferenceReason $reason;

    /**
     * @return Story
     */
    public function getFromStory(): Story
    {
        return $this->fromStory;
    }

    /**
     * @return Story
     */
    public function getToStory(): Story
    {
        return $this->toStory;
    }
}