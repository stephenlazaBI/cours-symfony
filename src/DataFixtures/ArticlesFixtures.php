<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //$faker = \Faker\Factory::create('fr_FR');

        for ($i=0; $i<2; $i++){
            $article = new Article();

            //$content = '<p>'. join($faker->paragraph(5),'</p><p>') .'</p>';

            $article->setTitre('Titre n°'.$i)
                    ->setContenu('contenu'.$i)
                    ->setImage('http://placehold.it/350x150')
                    ->setCreatedAt(new \DateTime());

            $manager->persist($article);

            for($j=1; $j<=2; $j++){
                $commentaire = new Commentaire();
                //$content = '<p>'. join($faker->paragraph(5),'</p><p>') .'</p>';

                //$now = new \DateTime();
                //$now->diff($article->getCreatedAt());
                //$interval = $now->diff($article->getCreatedAt());
                //$days = $interval->days;
                //$min = '-'.$days.'days';

                $commentaire->setPersonne('com n°'.$j)
                            ->setContenu('com bdb '.$j)
                            ->setCreatedAt(new \DateTime())
                            ->setArticle($article);
                $manager->persist($commentaire);
            }

        }

        $manager->flush();
    }
}
