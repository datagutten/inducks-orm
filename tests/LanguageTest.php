<?php

use datagutten\InducksORM\models\Language;
use Doctrine\ORM\EntityNotFoundException;
use PHPUnit\Framework\TestCase;


class LanguageTest extends TestCase
{
    public function testGetPublications()
    {
        $em = InducksORMBootstrap();
        $language = $em->find(Language::class, 'no');
        $publications = $language->getPublications();
        $this->assertGreaterThanOrEqual(261, count($publications));
    }

/*    public function testGetCharacterName()
    {
        $em = InducksORMBootstrap();
        $language = $em->find(Language::class, 'no');
        $name = $language->getCharacterNames()->first();
    }*/

    public function testLanguageName()
    {
        $language = InducksORMBootstrap()->find(Language::class, 'no');
        $this->assertEquals('Norwegian', $language->getName());
        $this->assertEquals('Norsk', $language->getLocalizedName('no'));
    }

    public function testLanguageNames()
    {
        $language = InducksORMBootstrap()->find(Language::class, 'fr');
        $names = $language->getNames()->getValues();
        $names2 = array_map(function (\datagutten\InducksORM\models\LanguageName $value)
        {
            return $value->getLanguageName();
        }, $names);
        $this->assertContains('Französisch', $names2);
        $this->assertContains('Fransk', $names2);
    }

    public function testLanguageName2()
    {
        $language = InducksORMBootstrap()->find(Language::class, 'fr');
        $this->assertEquals('French', $language->getName());
        $this->assertEquals('Fransk', $language->getLocalizedName('no'));
    }

    public function testInvalidLanguageName()
    {
        $language = InducksORMBootstrap()->find(Language::class, 'no');
        $this->expectException(EntityNotFoundException::class);
        $this->assertEquals('Norsk', $language->getLocalizedName('xx'));
    }
}
