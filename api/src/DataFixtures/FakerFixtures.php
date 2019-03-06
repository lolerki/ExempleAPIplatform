<?php
// src/DataFixtures/FakerFixtures.php
namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class FakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        // on créé 20 personnes
        for ($i = 0; $i < 20; $i++) {
            $author = new Author();
            $author->setLastname($faker->lastName);
            $author->setFirstname($faker->firstName);
            $author->setAge($faker->numberBetween($min = 15, $max = 99));
            $manager->persist($author);
        }

        /*for ($i = 0; $i < 20; $i++) {
            $book = new Book();
            $book->setReference($faker->ean13());
            $book->setName($faker->name());
            $book->setDescription($faker->text($maxNbChars = 200));
            $book->setPublicationDate($faker->dateTime());
            $book->setAuthor($author->getAuthor(1));

            $manager->persist($book);
        }*/

        $manager->flush();
    }
}