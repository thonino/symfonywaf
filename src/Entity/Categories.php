<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $windows;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $android;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWindows(): ?string
    {
        return $this->windows;
    }

    public function setWindows(?string $windows): self
    {
        $this->windows = $windows;

        return $this;
    }

    public function getAndroid(): ?string
    {
        return $this->android;
    }

    public function setAndroid(?string $android): self
    {
        $this->android = $android;

        return $this;
    }
}
