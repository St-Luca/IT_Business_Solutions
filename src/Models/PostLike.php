<?php

namespace App\Models;

class PostLike
{
    public $id;
    public $postId;
    public $authorId;

    public function __construct(string $id, string $postId, string $authorId)
    {
        $this->id = $id;
        $this->postId = $postId;
        $this->authorId = $authorId;
    }
}
