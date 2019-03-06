<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CopyBookRepository")
 */
class CopyBook
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $CopyBookNumber;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="copyBooks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Book;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Borrow", mappedBy="CopyBook")
     */
    private $borrows;

    public function __construct()
    {
        $this->borrows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCopyBookNumber(): ?int
    {
        return $this->CopyBookNumber;
    }

    public function setCopyBookNumber(int $CopyBookNumber): self
    {
        $this->CopyBookNumber = $CopyBookNumber;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->Book;
    }

    public function setBook(?Book $Book): self
    {
        $this->Book = $Book;

        return $this;
    }

    /**
     * @return Collection|Borrow[]
     */
    public function getBorrows(): Collection
    {
        return $this->borrows;
    }

    public function addBorrow(Borrow $borrow): self
    {
        if (!$this->borrows->contains($borrow)) {
            $this->borrows[] = $borrow;
            $borrow->setCopyBook($this);
        }

        return $this;
    }

    public function removeBorrow(Borrow $borrow): self
    {
        if ($this->borrows->contains($borrow)) {
            $this->borrows->removeElement($borrow);
            // set the owning side to null (unless already changed)
            if ($borrow->getCopyBook() === $this) {
                $borrow->setCopyBook(null);
            }
        }

        return $this;
    }
}
