<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"author_read"}},
 *     denormalizationContext={"groups"={"author_write"}},
 *     collectionOperations={
 *           "get"={
 *              "normalization_context"={"groups"={"author_get_read"}}
 *          },
 *          "post"
 *     },
 *     itemOperations={
 *           "get",
 *           "put",
 *           "delete"
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"author_read"})
     */
    private $id;

    /**
     * @Groups({"author_read", "author_write", "book_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $Lastname;

    /**
     * @Groups({"author_read", "author_write", "book_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $Firstname;

    /**
     * @Groups({"author_read", "author_write", "book_read"})
     * @ORM\Column(type="integer")
     */
    private $Age;

    /**
     * @Groups({"author_read"})
     * @ORM\OneToMany(targetEntity="App\Entity\Book", mappedBy="Author")
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): self
    {
        $this->Lastname = $Lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAuthor($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }

        return $this;
    }
}
