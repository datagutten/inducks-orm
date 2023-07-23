<?php

use datagutten\InducksORM\models\Country;
use PHPUnit\Framework\TestCase;


class CountryTest extends TestCase
{
    public function testGetPublications()
    {
        $em = InducksORMBootstrap();
        $country = $em->find(Country::class, 'no');
        $publications = $country->getPublications();
        $this->assertGreaterThanOrEqual(263, count($publications));
    }
}
