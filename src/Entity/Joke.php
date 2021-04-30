<?php

namespace App\Entity;

use App\Repository\JokeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JokeRepository::class)
 */
class Joke
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $setup;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $punchline;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetail::class, mappedBy="joke")
     */
    private $orderDetail;

    public function __construct()
    {
        $this->orderDetail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSetup(): ?string
    {
        return $this->setup;
    }

    public function setSetup(?string $setup): self
    {
        $this->setup = $setup;

        return $this;
    }

    public function getPunchline(): ?string
    {
        return $this->punchline;
    }

    public function setPunchline(?string $punchline): self
    {
        $this->punchline = $punchline;

        return $this;
    }

    /**
     * @return Collection|OrderDetail[]
     */
    public function getOrderDetail(): Collection
    {
        return $this->orderDetail;
    }

    public function addOrderDetail(OrderDetail $orderDetail): self
    {
        if (!$this->orderDetail->contains($orderDetail)) {
            $this->orderDetail[] = $orderDetail;
            $orderDetail->setJoke($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): self
    {
        if ($this->orderDetail->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getJoke() === $this) {
                $orderDetail->setJoke(null);
            }
        }

        return $this;
    }
}
