<?php

declare(strict_types=1);

namespace App\Entity;

use Ramsey\Uuid\UuidInterface;

trait EntityIdTrait
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected $id;

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
    }
}
