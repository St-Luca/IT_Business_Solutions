<?php

namespace App\Models;

class Comment
{
    public string $id;
    public string $authorId;
    public string $postId;
    public string $text;

    public function __construct($id, $authorId, $postId, $text)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->postId = $postId;
        $this->text = $text;
    }
}
