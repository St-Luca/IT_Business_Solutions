<?php

namespace App\Repositories;

use PDO;
use App\Models\Post;
use App\Repositories\Interfaces\PostsRepositoryInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class PostsRepository implements PostsRepositoryInterface
{
    private PDO $connection;
    private LoggerInterface $logger;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->logger = $this->createLogger();
    }

    private function createLogger(): LoggerInterface
    {
        if (class_exists('Tests\TestLogger')) {
            return new \Tests\TestLogger();
        }

        $logger = new Logger('posts');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/app.log', Logger::INFO));

        return $logger;
    }

    public function get(string $uuid): ?Post
    {
        $stmt = $this->connection->prepare('SELECT * FROM posts WHERE uuid = :uuid');
        $stmt->bindValue(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new Exception("Post with uuid $uuid not found");
            $this->logger->warning('No post found', ['postUuid' => $uuid]);
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

        $this->logger->info('Post saved', ['uuid' => $post->id]);
    }

    public function delete(string $uuid): void
    {
        $stmt = $this->connection->prepare('DELETE FROM posts WHERE uuid = :uuid');
        $stmt->bindValue(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            throw new Exception("Post with uuid $uuid not found");
            $this->logger->warning('No post found', ['postUuid' => $uuid]);
        }
    }
}
