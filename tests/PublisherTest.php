<?php

use datagutten\InducksORM\models\Issue;
use datagutten\InducksORM\models\Publisher;
use datagutten\InducksORM\models\PublishingJob;
use PHPUnit\Framework\TestCase;

class PublisherTest extends TestCase
{

    public function testGetJobs()
    {
        $publisher = InducksORMBootstrap()->find(Publisher::class, 'Egmont');
        $jobs = $publisher->getJobs();
        $this->assertInstanceOf(PublishingJob::class, $jobs->first());
        $this->assertInstanceOf(Issue::class, $jobs->first()->getIssue());
    }
}
