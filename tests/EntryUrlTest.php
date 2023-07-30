<?php

use datagutten\InducksORM\models\Entry;
use PHPUnit\Framework\TestCase;


class EntryUrlTest extends TestCase
{
    public function testGetThumbnailUrl()
    {
        $entry = InducksORMBootstrap()->find(Entry::class, 'no/DD2001-32a');
        $url = $entry->getThumbnailUrl();
        $this->assertEquals('https://inducks.org/hr.php?normalsize=1&image=https%3A%2F%2Foutducks.org%2Fno%2Fdd/2001/no_dd2001_32a_001.jpg', $url);
    }
}
