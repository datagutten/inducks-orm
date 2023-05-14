<?php


use datagutten\InducksORM\models\Entry;
use PHPUnit\Framework\TestCase;

class EntryJobTest extends TestCase
{
    public function testGetRoleName()
    {
        $em = InducksORMBootstrap();
        $entry = $em->find(Entry::class, 'no/CBSV 10c');
        $job = $entry->getJobs()->first();
        $this->assertEquals('translator', $job->getRoleName());
    }
}
