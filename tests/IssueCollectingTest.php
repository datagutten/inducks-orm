<?php

use datagutten\InducksORM\models\Issue;
use PHPUnit\Framework\TestCase;


class IssueCollectingTest extends TestCase
{
    public function testIssueCollected()
    {
        $issue = InducksORMBootstrap()->find(Issue::class, 'no/DD1948-01');
        $collected = $issue->getCollected()->getValues();
        $this->assertCount(6, $collected);
    }

    public function testIssueCollecting()
    {
        $issue = InducksORMBootstrap()->find(Issue::class, 'no/AAR   1');
        $collecting = $issue->getCollecting()->getValues();
        $this->assertCount(13, $collecting);
    }
}
