<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $users = [];
        $categories = [];
        $articles = [];

        for ($i=0; $i < 50; $i++) { 
            // creation d'un user
            $user = new User;
            //utilisation des setters pour lui affecter des valeurs
            $user->setUsername($faker->name)->setFirstname($faker->firstname)->setLastname($faker->lastname)->setEmail($faker->email)->setPassword($faker->password)
                // on utilise \DateTime pour indiquer a symfony que c'est une fonction native de php et pas une classe créée dans symfony
                ->setCreatedAt(new \DateTime);

            // enregistre les données coté PHP
            $manager->persist($user);

            $users[] = $user;
        }

        for ($i=0; $i < 15; $i++) { 
            $category = new Category;
            $category->setTitle($faker->word)->setImage($faker->imageUrl())->setDescription($faker->text(50));

            $manager->persist($category);

            $categories[] = $category;
        }

        for ($i=0; $i < 100; $i++) { 
            $article = new Article;
            $article
                ->setTitle($faker->text(50))
                ->setContent($faker->text(6000))
                ->setImage($faker->imageUrl())
                ->setCreatedAt(new \DateTime)
                ->addCategory($categories[$faker->numberBetween(0,14)])
                ->setAuthor($users[$faker->numberBetween(0,49)]);

            $manager->persist($article);

            $articles[] = $article;
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
