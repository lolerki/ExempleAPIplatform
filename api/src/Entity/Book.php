<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"book_read"}},
 *     denormalizationContext={"groups"={"book_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"book_read", "book_write"})
     * @ORM\Column(type="string", length=255)
     */
    private $Reference;

    /**
     * @Groups({"book_read", "book_write"})
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @Groups({"book_read", "book_write"})
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @Groups({"book_read", "book_write"})
     * @ORM\Column(type="datetime")
     */
    private $PublicationDate;

    /**
     * @Groups({"book_read"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CopyBook", mappedBy="Book")
     * @Groups({"book_read"})
     */
    private $copyBooks;

    public function __construct()
    {
        $this->copyBooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->Reference;
    }

    public function setReference(string $Reference): self
    {
        $this->Reference = $Reference;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->PublicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $PublicationDate): self
    {
        $this->PublicationDate = $PublicationDate;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->Author;
    }

    public function setAuthor(?Author $Author): self
    {
        $this->Author = $Author;

        return $this;
    }

    /**
     * @return Collection|CopyBook[]
     */
    public function getCopyBooks(): Collection
    {
        return $this->copyBooks;
    }

    public function addCopyBook(CopyBook $copyBook): self
    {
        if (!$this->copyBooks->contains($copyBook)) {
            $this->copyBooks[] = $copyBook;
            $copyBook->setBook($this);
        }

        return $this;
    }

    public function removeCopyBook(CopyBook $copyBook): self
    {
        if ($this->copyBooks->contains($copyBook)) {
            $this->copyBooks->removeElement($copyBook);
            // set the owning side to null (unless already changed)
            if ($copyBook->getBook() === $this) {
                $copyBook->setBook(null);
            }
        }

        return $this;
    }
}
