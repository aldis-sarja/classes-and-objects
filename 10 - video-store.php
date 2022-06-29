<?php

declare(strict_types=1);

class Application
{
    public VideoStore $videoStore;

    public function __construct()
    {
        $this->videoStore = new VideoStore();
    }

    function run()
    {
        $this->videoStore->add('The Matrix');
        $this->videoStore->add("Godfather II");
        $this->videoStore->add("Star Wars Episode IV: A New Hope");

        while (true) {
            echo "===============MENU=====================\n";
            echo "Choose the operation you want to perform \n";
            echo "Choose 0 for EXIT\n";
            echo "Choose 1 to fill video store\n";
            echo "Choose 2 to rent video (as user)\n";
            echo "Choose 3 to return video (as user)\n";
            echo "Choose 4 to list inventory\n";

            $command = (int)readline();
            echo "========================================\n";

            switch ($command) {
                case 0:
                    echo "Bye!";
                    die;
                case 1:
                    $this->addMovies();
                    break;
                case 2:
                    $this->rentVideo();
                    break;
                case 3:
                    $this->returnVideo();
                    break;
                case 4:
                    $this->listInventory(true);
                    break;
                default:
                    echo "Sorry, I don't understand you..";
            }
        }
    }

    private function addMovies(): void
    {
        while (true) {
            $movie = readline("Enter title or 'q' for quit: ");
            if ($movie === 'q') {
                return;
            }
            $this->videoStore->add($movie);
        }
    }

    private function rentVideo(): void
    {
        $this->listInventory(true);
        $movie = readline("Enter title or 'q' for quit: ");
        if ($movie === 'q') {
            return;
        }

        if (!$this->videoStore->checkOut($movie)) {
            echo "There is not such movie!\n";
            return;
        }
        echo "Take it and enjoy!\n";
    }

    private function returnVideo(): void
    {
        $this->listInventory(false);
        $movie = readline("Enter title or 'q' for quit: ");
        if ($movie === 'q') {
            return;
        }

        if (!$this->videoStore->giveBack($movie)) {
            echo "This movie is not from our store!\n";
            return;
        }

        $rating = (int)readline("Give us rating for movie (1 - 10): ");
        $this->videoStore->rateVideo($movie, $rating);
        echo "Thanks!\n";
    }

    private function listInventory(bool $inStore)
    {
        $movies = $this->videoStore->list($inStore);
        foreach ($movies as $movie) {
            echo $movie->getTitle() . " | Rating: " . $movie->getRating() . PHP_EOL;
        }
        echo PHP_EOL;
    }
}

class VideoStore
{

    private array $movies = [];

    public function add(string $video): void
    {
        $this->movies[] = new Video($video);
    }

    public function checkOut(string $title): ?Video
    {
        foreach ($this->movies as $video) {
            if ($video->getTitle() === $title) {
                $video->checkedOut();
                return $video;
            }
        }
        return null;
    }

    public function giveBack(string $title): ?Video
    {
        foreach ($this->movies as $video) {
            if ($video->getTitle() === $title) {
                $video->returned();
                return $video;
            }
        }
        return null;
    }

    public function rateVideo(string $title, int $rating): void
    {
        foreach ($this->movies as $video) {
            if ($video->getTitle() === $title) {
                $video->setRating($rating);
                return;
            }
        }
    }

    public function list(bool $inStore): array
    {
        return array_filter($this->movies, function ($video) use ($inStore) {
            return !$video->getChecked() === $inStore;
        });
    }
}

class Video
{
    private string $title;
    private bool $checked = false;
    private int $rating = 0;
    private bool $ratingCount = false;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        if ($this->ratingCount === false) {
            $this->rating = $rating;
            $this->ratingCount = true;
        } else {
            $this->rating = (int)(($rating + $this->rating) / 2);
        }
    }

    public function getChecked(): bool
    {
        return $this->checked;
    }

    public function checkedOut(): void
    {
        $this->checked = true;
    }

    public function returned(): void
    {
        $this->checked = false;
    }

}

class VideoStoreTest
{
    public function run(): void
    {
        $videoStore = new VideoStore();
        $videoStore->add('The Matrix');
        $videoStore->add("Godfather II");
        $videoStore->add("Star Wars Episode IV: A New Hope");
        $videoStore->rateVideo('The Matrix', 1);
        $videoStore->rateVideo('The Matrix', 2);
        $videoStore->rateVideo('The Matrix', 3);
        $videoStore->rateVideo('Godfather II', 7);
        $videoStore->rateVideo('Godfather II', 8);
        $videoStore->rateVideo('Godfather II', 10);
        $videoStore->rateVideo('Star Wars Episode IV: A New Hope', 7);
        $videoStore->rateVideo('Star Wars Episode IV: A New Hope', 1);
        $videoStore->rateVideo('Star Wars Episode IV: A New Hope', 3);
        $videoStore->checkOut('The Matrix');
        $videoStore->giveBack('The Matrix');
        $videoStore->checkOut('Star Wars Episode IV: A New Hope');
        $videoStore->giveBack('Star Wars Episode IV: A New Hope');
        $videoStore->checkOut('Godfather II');
        /**
         * @var Video $movie
         */
        $movies = $videoStore->list(true);
        foreach($movies as $movie) {
            echo $movie->getTitle() . " | Rating: " . $movie->getRating() . PHP_EOL;
        }
        $videoStore->giveBack('Godfather II');
    }
}

$app = new Application();
$app->run();


//(new VideoStoreTest())->run();
