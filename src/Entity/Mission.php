<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Mission
{
    use EntityIdTrait;

    /**
     * @var Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    /**
     * @var InterventionGroup[] | \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="InterventionGroup")
     */
    private $groups;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3)
     */
    private $name;

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): Mission
    {
        $this->location = $location;

        return $this;
    }

    public function getGroups(): \Doctrine\Common\Collections\Collection
    {
        return $this->groups;
    }

    public function setGroups(array $groups): Mission
    {
        $this->groups = $groups;

        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): Mission
    {
        $this->date = $date;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Mission
    {
        $this->name = $name;

        return $this;
    }
}
