<?php

declare(strict_types=1);

namespace Database\Fixtures;

use Database\Fixtures\FakerProvider\RamseyUuid;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as FakerGeneratorFactory;
use Faker\Generator as FakerGenerator;
use Nelmio\Alice\Faker\Provider\AliceProvider;
use Nelmio\Alice\Loader\NativeLoader;

class LoadFixture extends NativeLoader
{
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
        parent::__construct();
    }

    protected function createFakerGenerator(): FakerGenerator
    {
        $generator = FakerGeneratorFactory::create('fr_FR');
        $generator->addProvider(new AliceProvider());
        $generator->seed($this->getSeed());

        $this->objectManager;

        return $generator;
    }
}
