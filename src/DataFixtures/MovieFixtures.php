<?php

namespace App\DataFixtures;

use App\Admin\Movie\Domain\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public const string UUID_MOVIE_1 = '019f7644-68e1-72fa-a544-f352709361b9';
    public const string UUID_MOVIE_2 = '019f7657-6972-7155-ab57-2eb920fba377';
    public const string UUID_MOVIE_3 = '019f7657-c540-76ee-b07c-d32cf4c92b2a';
    public function load(ObjectManager $manager): void
    {
        $this->createMovie(
            manager: $manager,
            title: 'Titanic',
            poster: 'https://antreducinema.fr/wp-content/uploads/2020/04/Titanic.jpg',
            description: 'description du film 1 dans les fixtures.',
            genres: 'Action',
            directing: 'John Doe',
            releaseDate: new \DateTimeImmutable()->modify('-1 year'),
            voteAverage: 4.5,
            voteCount: 3578,
            id: self::UUID_MOVIE_1,
        );

        $this->createMovie(
            manager: $manager,
            title: 'Avatar',
            poster: 'https://cdng.europosters.eu/pod_public/750/262965.jpg',
            genres: 'Comédie, Thriller',
            releaseDate: new \DateTimeImmutable()->modify('-42 months'),
            id: self::UUID_MOVIE_2,
        );

        $this->createMovie(
            manager: $manager,
            title: 'Scary Movie 6',
            voteAverage: 1.7,
            voteCount: 1247,
            id: self::UUID_MOVIE_3,
        );

        $manager->flush();
    }

    private function createMovie(
        ObjectManager $manager,
        string $title,
        ?string $poster = null,
        ?string $description = null,
        ?string $genres = null,
        ?string $directing = null,
        ?\DateTimeImmutable $releaseDate = null,
        ?float $voteAverage = null,
        ?int $voteCount = null,

        ?string $id = null,
    ): Movie {
        $movie = Movie::create(
            title: $title,
            poster: $poster,
            description: $description,
            genres: $genres,
            directing: $directing,
            releaseDate: $releaseDate,
            voteAverage: $voteAverage,
            voteCount: $voteCount,
            id: $id,
        );

        $manager->persist($movie);
        $this->addReference(name: 'movie_'.$movie->getId(), object: $movie);

        return $movie;
    }
}
