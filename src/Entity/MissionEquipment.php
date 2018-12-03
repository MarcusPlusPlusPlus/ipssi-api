<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class MissionEquipment
{
    use EntityIdTrait;

    /**
     * @var Armory
     *
     * @ORM\ManyToOne(targetEntity="Armory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $armory;

    /**
     * @var Mission
     *
     * @ORM\ManyToOne(targetEntity="Mission")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function getArmory(): Armory
    {
        return $this->armory;
    }

    public function setArmory(Armory $armory): MissionEquipment
    {
        $this->armory = $armory;

        return $this;
    }

    public function getMission(): Mission
    {
        return $this->mission;
    }

    public function setMission(Mission $mission): MissionEquipment
    {
        $this->mission = $mission;

        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): MissionEquipment
    {
        $this->quantity = $quantity;

        return $this;
    }
}
