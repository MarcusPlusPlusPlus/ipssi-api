<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 */
class Crs
{
    use EntityIdTrait;

    /**
     * @var string
     *
     * @Groups({"Default"})
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @Groups({"Default"})
     * @ORM\Column(type="string")
     */
    protected $accessLevel;

    /**
     * @var string
     *
     * @Groups({"Default"})
     * @ORM\Column(type="string")
     */
    protected $registrationNumber;

    /**
     * @var string
     *
     * @Groups({"Default"})
     * @ORM\Column(type="string")
     */
    protected $dream;

    /**
     * @var InterventionGroup
     *
     * @Groups({"Hidden"})
     * @ORM\ManyToOne(targetEntity="InterventionGroup", inversedBy="crs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $group;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Crs
    {
        $this->name = $name;

        return $this;
    }

    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }

    public function setAccessLevel(string $accessLevel): Crs
    {
        $this->accessLevel = $accessLevel;

        return $this;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function setRegistrationNumber(string $registrationNumber): Crs
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    public function getDream(): string
    {
        return $this->dream;
    }

    public function setDream(string $dream): Crs
    {
        $this->dream = $dream;

        return $this;
    }

    public function getGroup(): InterventionGroup
    {
        return $this->group;
    }

    public function setGroup(InterventionGroup $group): Crs
    {
        $this->group = $group;

        return $this;
    }
}
