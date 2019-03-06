<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\BorrowRepository")
 */
class Borrow
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $BorrowingDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ReturnDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $State;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Borrowers", inversedBy="borrows")
     */
    private $Borrowers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CopyBook", inversedBy="borrows")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CopyBook;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowingDate(): ?\DateTimeInterface
    {
        return $this->BorrowingDate;
    }

    public function setBorrowingDate(\DateTimeInterface $BorrowingDate): self
    {
        $this->BorrowingDate = $BorrowingDate;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->ReturnDate;
    }

    public function setReturnDate(\DateTimeInterface $ReturnDate): self
    {
        $this->ReturnDate = $ReturnDate;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->State;
    }

    public function setState(string $State): self
    {
        $this->State = $State;

        return $this;
    }

    public function getBorrowers(): ?Borrowers
    {
        return $this->Borrowers;
    }

    public function setBorrowers(?Borrowers $Borrowers): self
    {
        $this->Borrowers = $Borrowers;

        return $this;
    }

    public function getCopyBook(): ?CopyBook
    {
        return $this->CopyBook;
    }

    public function setCopyBook(?CopyBook $CopyBook): self
    {
        $this->CopyBook = $CopyBook;

        return $this;
    }
}
