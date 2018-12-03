<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Armory
{
    use EntityIdTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $cost;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $stock;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Armory
    {
        $this->name = $name;

        return $this;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(int $cost): Armory
    {
        $this->cost = $cost;

        return $this;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): Armory
    {
        $this->stock = $stock;

        return $this;
    }
}
