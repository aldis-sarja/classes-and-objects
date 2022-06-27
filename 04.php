<?php

declare(strict_types=1);

class Movie
{
    public string $title;
    public string $studio;
    public string $rating;

    public function __construct(string $title, string $studio, string $rating)
    {
        $this->title = $title;
        $this->studio = $studio;
        $this->rating = $rating;
    }
}

function getPG(array $movies): array
{
    $result = [];
    foreach ($movies as $movie) {
        if (strpos($movie->rating, 'PG') !== false) {
            $result[] = $movie;
        }
    }
    return $result;
}

$movies = [
    new Movie("Casino Royale", "Eon Productions", "PG13"),
    new Movie("Glass", "Buena Vista International", "PG13"),
    new Movie("Spider-Man: Into the Spider-Verse", "Columbia Pictures", "PG"),
];

var_dump(getPG($movies));
