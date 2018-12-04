<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InterventionGroupRepository")
 */
class InterventionGroup
{
    use EntityIdTrait;

    /**
     * @var Location
     *
     * @Groups({"FullInterventionGroup"})
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumn(nullable=false)
     */
    private $barrackLocation;

    /**
     * @var string
     *
     * @Groups({"FullInterventionGroup"})
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var Crs[]|Collection
     *
     * @Groups({"FullInterventionGroup"})
     * @ORM\OneToMany(targetEntity="Crs", mappedBy="group")
     */
    private $crs;


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

    public function getCrs(): Collection
    {
        return $this->crs;
    }

    /**
     * @param Crs[]|Collection $crs
     * @return InterventionGroup
     */
    public function setCrs($crs): self
    {
        $this->crs = $crs;

        return $this;
    }
}
