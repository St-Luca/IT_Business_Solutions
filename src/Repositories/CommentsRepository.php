<?php

namespace App\Repositories;

use PDO;
use App\Models\Comment;
use App\Repositories\Interfaces\CommentsRepositoryInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class CommentsRepository implements CommentsRepositoryInterface
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

        $logger = new Logger('comments');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/app.log', Logger::INFO));

        return $logger;
    }

    public function get(string $uuid): ?Comment
    {
        $stmt = $this->connection->prepare('SELECT * FROM comments WHERE uuid = :uuid');
        $stmt->bindValue(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new Exception("Comment with uuid $uuid not found");
            $this->logger->warning('No comment found', ['commentUuid' => $uuid]);
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

        $this->logger->info('Comment saved', ['uuid' => $comment->id]);
    }
}
