<?php

use datagutten\InducksORM\models\ReferenceReason;
use PHPUnit\Framework\TestCase;


class ReferenceReasonTest extends TestCase
{

    public function testGetLocalizedName()
    {
        $reason = InducksORMBootstrap()->find(ReferenceReason::class, 11);
        $name = $reason->getLocalizedName('nl');
        $this->assertEquals('opvolging', $name);
    }
}
