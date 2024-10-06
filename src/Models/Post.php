<?php

namespace App\Models;

class Post
{
    public string $id;
    public string $authorId;
    public string $title;
    public string $text;

    public function __construct($id, $authorId, $title, $text)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->title = $title;
        $this->text = $text;
    }
}
