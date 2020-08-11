<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<10; $i++){
            $article = new Article();
            $article->setTitre("TITRE $i")
                    ->setContenu("<p>BLA BLA</p>")
                    ->setImage("http://placehold.it/350x150")
                    ->setCommentaire("merci")
                    ->setCreatedAt(new \DateTime());
            $manager->persist($article);

        }

        $manager->flush();
    }
}
