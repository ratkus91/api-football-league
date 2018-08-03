<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups as SerializerGroup;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @SerializerGroup({"group"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     *
     * @SerializerGroup({"group"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @SerializerGroup({"group"})
     */
    private $strip;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\League", inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $league;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Team
     */
    public function setName(string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getStrip(): ?string
    {
        return $this->strip;
    }

    /**
     * @param string|null $strip
     * @return Team
     */
    public function setStrip(string $strip = null): self
    {
        $this->strip = $strip;

        return $this;
    }

    /**
     * @return League|null
     */
    public function getLeague(): ?League
    {
        return $this->league;
    }

    /**
     * @param League|null $league
     * @return Team
     */
    public function setLeague(?League $league = null): self
    {
        $this->league = $league;

        return $this;
    }
}
