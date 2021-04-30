<?php

namespace App\Entity;

use App\Repository\GadgetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GadgetRepository::class)
 */
class Gadget
{
    public function hydrate(array $init)
    {
        foreach ($init as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $samplePicture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetail::class, mappedBy="gadget")
     */
    private $orderDetail;

    public function __construct($arrayInit = [])
    {
        $this->orderDetail = new ArrayCollection();
        // appel au hydrate
        $this->hydrate($arrayInit);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSamplePicture(): ?string
    {
        return $this->samplePicture;
    }

    public function setSamplePicture(?string $samplePicture): self
    {
        $this->samplePicture = $samplePicture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

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
            $orderDetail->setGadget($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): self
    {
        if ($this->orderDetail->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getGadget() === $this) {
                $orderDetail->setGadget(null);
            }
        }

        return $this;
    }
}
