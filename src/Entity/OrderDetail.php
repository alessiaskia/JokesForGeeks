<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderDetailRepository::class)
 */
class OrderDetail
{
    // public function hydrate(array $init)
    // {
    //     foreach ($init as $key => $value) {
    //         $method = "set" . ucfirst($key);
    //         if (method_exists($this, $method)) {
    //             $this->$method($value);
    //         }
    //     }
    // }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Gadget::class, inversedBy="orderDetail")
     */
    private $gadget;


    /**
     * @ORM\ManyToOne(targetEntity=Joke::class, inversedBy="orderDetail")
     */
    private $joke;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderDetails")
     */
    private $orderMade;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getGadget(): ?Gadget
    {
        return $this->gadget;
    }

    public function setGadget(?Gadget $gadget): self
    {
        $this->gadget = $gadget;

        return $this;
    }


    public function getJoke(): ?Joke
    {
        return $this->joke;
    }

    public function setJoke(?Joke $joke): self
    {
        $this->joke = $joke;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getOrderMade(): ?Order
    {
        return $this->orderMade;
    }

    public function setOrderMade(?Order $orderMade): self
    {
        $this->orderMade = $orderMade;

        return $this;
    }
}
