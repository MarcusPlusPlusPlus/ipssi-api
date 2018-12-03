<?php

declare(strict_types=1);

namespace Database\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FixturesLoader extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $loader  = new LoadFixture($manager);
        $objectSet = $loader->loadFile(__DIR__ . '/fixtures.yaml');

        foreach ($objectSet->getObjects() as $object) {
            $manager->persist($object);
        }

        $manager->flush();
    }
}
