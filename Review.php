<?php
class Review
{
    public $userId;
    public $productId;
    public $rating;
    public $comment;

    public function __construct($userId, $productId, $rating, $comment)
    {
        $this->userId = $userId;
        $this->productId = $productId;
        $this->rating = $rating;
        $this->comment = $comment;
    }

    public function updateRating($rating)
    {
        $this->rating = $rating;
    }

    public function updateComment($comment)
    {
        $this->comment = $comment;
    }
}
