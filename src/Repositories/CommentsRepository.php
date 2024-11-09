<?php

namespace App\Repositories;

use PDO;
use App\Models\Comment;
use App\Repositories\Interfaces\CommentsRepositoryInterface;
use Exception;

class CommentsRepository implements CommentsRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function get(string $uuid): ?Comment
    {
        $stmt = $this->connection->prepare('SELECT * FROM comments WHERE uuid = :uuid');
        $stmt->bindValue(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new Exception("Comment with uuid $uuid not found");
        }

        return new Comment($result['uuid'], $result['author_uuid'], $result['post_uuid'], $result['text']);
    }

    public function save(Comment $comment): void
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO comments (uuid, author_uuid, post_uuid, text) VALUES (:uuid, :author_uuid, :post_uuid, :text)'
        );
        $stmt->bindValue(':uuid', $comment->id, PDO::PARAM_STR);
        $stmt->bindValue(':author_uuid', $comment->authorId, PDO::PARAM_STR);
        $stmt->bindValue(':post_uuid', $comment->postId, PDO::PARAM_STR);
        $stmt->bindValue(':text', $comment->text, PDO::PARAM_STR);
        $stmt->execute();
    }
}
