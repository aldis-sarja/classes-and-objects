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
        while (true) {
            echo "========================================\n";
            echo "Choose the operation you want to perform \n";
            echo "Choose 0 for EXIT\n";
            echo "Choose 1 to fill video store\n";
            echo "Choose 2 to rent video (as user)\n";
            echo "Choose 3 to return video (as user)\n";
            echo "Choose 4 to list inventory\n";

            $command = (int)readline();

            switch ($command) {
                case 0:
                    echo "Bye!";
                    die;
                case 1:
                    $this->add_movies();
                    break;
                case 2:
                    $this->rent_video();
                    break;
                case 3:
                    $this->return_video();
                    break;
                case 4:
                    $this->list_inventory();
                    break;
                default:
                    echo "Sorry, I don't understand you..";
            }
        }
    }

    private function add_movies()
    {
        while (true) {
            $movie = readline("Enter title or 'q' for quit: ");
            if ($movie === 'q') {
                return;
            }
            $this->videoStore->add($movie);
        }
    }

    private function rent_video()
    {
        $movie = readline("Enter title or 'q' for quit: ");
        if ($movie === 'q') {
            return;
        }
        $what = $this->videoStore->checkOut($movie);
        if (!$what) {
            echo "There is not such movie!\n";
            return;
        }
        echo "Take it and enjoy!\n";
    }

    private function return_video()
    {
        $movie = readline("Enter title or 'q' for quit: ");
        if ($movie === 'q') {
            return;
        }
        $what = $this->videoStore->returnVideo($movie);
        if (!$what) {
            echo "This movie is not from our store!\n";
            return;
        }
        $rating = (int)readline("Give us rating for movie (1 - 10): ");
        $this->videoStore->rateVideo($movie, $rating);
        echo "Thanks!\n";
    }

    private function list_inventory()
    {
        $this->videoStore->list();
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

    public function returnVideo(string $title): ?Video
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

    public function list(): void
    {
        foreach ($this->movies as $video) {
            echo str_repeat('-', strlen($video->getTitle())) . PHP_EOL;
            echo $video->getTitle() . PHP_EOL;
            echo "Rating: " . $video->getRating() . PHP_EOL;
            $isAviable = 'YES';
            if ($video->getChecked()) {
                $isAviable = 'NO';
            }
            echo "Is aviable: {$isAviable}\n";
        }
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

$app = new Application();
$app->run();
