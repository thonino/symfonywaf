<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 100)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'string', length: 5)]
    private $zipcode;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $stripeSuccessKey;

    #[ORM\Column(type: 'boolean')]
    private $paid;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $piStripe;

    #[ORM\Column(type: 'string', length: 255)]
    private $totalPrice;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $lessonName;

    #[ORM\Column(type: 'string', length: 3, nullable: true)]
    private $lessonQty;

    #[ORM\Column(type: 'string', length: 100)]
    private $lessonTitle;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStripeSuccessKey(): ?string
    {
        return $this->stripeSuccessKey;
    }

    public function setStripeSuccessKey(?string $stripeSuccessKey): self
    {
        $this->stripeSuccessKey = $stripeSuccessKey;

        return $this;
    }

    public function getPaid(): ?bool
    {
        return $this->paid;
    }

    public function setPaid(bool $paid): self
    {
        $this->paid = $paid;

        return $this;
    }

    public function getPiStripe(): ?string
    {
        return $this->piStripe;
    }

    public function setPiStripe(?string $piStripe): self
    {
        $this->piStripe = $piStripe;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(string $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getLessonName(): ?string
    {
        return $this->lessonName;
    }

    public function setLessonName(?string $lessonName): self
    {
        $this->lessonName = $lessonName;

        return $this;
    }

    public function getLessonQty(): ?string
    {
        return $this->lessonQty;
    }

    public function setLessonQty(?string $lessonQty): self
    {
        $this->lessonQty = $lessonQty;

        return $this;
    }

    public function getLessonTitle(): ?string
    {
        return $this->lessonTitle;
    }

    public function setLessonTitle(string $lessonTitle): self
    {
        $this->lessonTitle = $lessonTitle;

        return $this;
    }
}
