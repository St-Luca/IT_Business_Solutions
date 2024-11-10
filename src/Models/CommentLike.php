<?php

namespace App\Models;

class CommentLike
{
    public $id;
    public $commentId;
    public $authorId;

    public function __construct(string $id, string $commentId, string $authorId)
    {
        $this->id = $id;
        $this->commentId = $commentId;
        $this->authorId = $authorId;
    }
}
