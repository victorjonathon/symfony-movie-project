<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle('The Dark Knight');
        $movie->setReleaseYear(2004);
        $movie->setDescription('Lorem ipsum is simply dummy description for the movie here.');
        $movie->setImagePath('https://images.thedirect.com/media/article_full/Batman.jpg');

        $movie->addActor($this->getReference('actor'));
        $movie->addActor($this->getReference('actor2'));

        $manager->persist($movie);

        $movie2 = new Movie();
        $movie2->setTitle('Avengers: Endgame');
        $movie2->setReleaseYear(2019);
        $movie2->setDescription('Lorem ipsum is simply dummy description for the movie here.');
        $movie2->setImagePath('https://imageio.forbes.com/blogs-images/markhughes/files/2019/04/AVENGERS-ENDGAME-poster-DOLBY-CINEMA.jpg');

        $movie->addActor($this->getReference('actor3'));
        $movie->addActor($this->getReference('actor4'));

        $manager->persist($movie2);

        $manager->flush();
    }
}
