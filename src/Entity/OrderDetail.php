<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderDetailRepository::class)
 */
class OrderDetail
{
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
     * @ORM\ManyToOne(targetEntity=OptionGadget::class, inversedBy="orderDetails")
     */
    private $optionGadget;

    /**
     * @ORM\ManyToOne(targetEntity=Joke::class, inversedBy="orderDetail")
     */
    private $joke;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderDetail")
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

    public function getOptionGadget(): ?OptionGadget
    {
        return $this->optionGadget;
    }

    public function setOptionGadget(?OptionGadget $optionGadget): self
    {
        $this->optionGadget = $optionGadget;

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
