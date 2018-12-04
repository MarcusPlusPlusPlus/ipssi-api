<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class InterventionGroup
{
    use EntityIdTrait;

    /**
     * @var Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumn(nullable=false)
     */
    private $barrackLocation;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    public function getBarrackLocation(): Location
    {
        return $this->barrackLocation;
    }

    public function setBarrackLocation(Location $barrackLocation): InterventionGroup
    {
        $this->barrackLocation = $barrackLocation;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): InterventionGroup
    {
        $this->name = $name;

        return $this;
    }
}
