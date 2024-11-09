<?php

namespace App\Repositories;

use PDO;
use App\Models\Post;
use App\Repositories\Interfaces\PostsRepositoryInterface;
use Exception;

class PostsRepository implements PostsRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function get(string $uuid): ?Post
    {
        $stmt = $this->connection->prepare('SELECT * FROM posts WHERE uuid = :uuid');
        $stmt->bindValue(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new Exception("Post with uuid $uuid not found");
        }

        return new Post($result['uuid'], $result['author_uuid'], $result['title'], $result['text']);
    }

    public function save(Post $post): void
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO posts (uuid, author_uuid, title, text) VALUES (:uuid, :author_uuid, :title, :text)'
        );
        $stmt->bindValue(':uuid', $post->id, PDO::PARAM_STR);
        $stmt->bindValue(':author_uuid', $post->authorId, PDO::PARAM_STR);
        $stmt->bindValue(':title', $post->title, PDO::PARAM_STR);
        $stmt->bindValue(':text', $post->text, PDO::PARAM_STR);
        $stmt->execute();
    }
}
