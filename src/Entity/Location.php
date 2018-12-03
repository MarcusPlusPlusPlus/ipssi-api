<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 */
class Location
{
    use EntityIdTrait;

    /**
     * @var string
     *
     * @Groups({"FullInterventionGroup"})
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="`long`")
     */
    private $long;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Location
    {
        $this->name = $name;

        return $this;
    }

    public function getLat(): string
    {
        return $this->lat;
    }

    public function setLat(string $lat): Location
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLong(): string
    {
        return $this->long;
    }

    public function setLong(string $long): Location
    {
        $this->long = $long;

        return $this;
    }
}
