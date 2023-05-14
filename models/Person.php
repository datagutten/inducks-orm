<?php

namespace datagutten\InducksORM\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 *
 * @author dromanin
 */
#[ORM\Table(name: 'inducks_person')]
#[ORM\Entity(readOnly: true)]
class Person
{
    #[ORM\Column(type: 'string')]
    #[ORM\Id]
    private string $personcode;

    #[ORM\Column(type: 'string')]
    private string $fullname;

    public function getPersoncode(): string
    {
        return $this->personcode;
    }

    public function getFullname(): string
    {
        return $this->fullname;
    }
}
