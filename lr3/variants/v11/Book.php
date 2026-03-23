<?php
class Book
{
    public string $title;
    public string $author;
    public int $year;

    public function __construct(string $title = '', string $author = '', int $year = 0)
    {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    public function getInfo(): string
    {
        return "Книга: {$this->title}, Автор: {$this->author}, Рік: {$this->year}";
    }

    public function __clone(): void
    {
        $this->title = "Без назви";
        $this->author = "";
        $this->year = 0;
    }
}