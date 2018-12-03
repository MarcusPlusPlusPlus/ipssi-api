<?php

declare(strict_types=1);

namespace Database\Fixtures;

use Faker\Provider\Base as BaseProvider;
use Faker\Provider\Uuid as FakerUuid;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class RamseyUuid extends BaseProvider
{
    public function ramseyUuid(string $uuid = null): UuidInterface
    {
        if ($uuid !== null) {
            return Uuid::fromString($uuid);
        }

        return Uuid::fromString(FakerUuid::uuid());
    }
}
