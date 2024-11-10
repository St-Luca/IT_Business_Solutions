<?php

namespace App\Repositories;

use PDO;
use App\Models\PostLike;
use App\Models\CommentLike;
use App\Repositories\Interfaces\LikesRepositoryInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LikesRepository implements LikesRepositoryInterface
{
    private PDO $pdo;
    private LoggerInterface $logger;

    public function __construct(PDO $connection)
    {
        $this->pdo = $connection;
        $this->logger = $this->createLogger();
    }

    private function createLogger(): LoggerInterface
    {
        if (class_exists('Tests\TestLogger')) {
            return new \Tests\TestLogger();
        }

        $logger = new Logger('likes');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/app.log', Logger::INFO));

        return $logger;
    }

    public function savePostLike(PostLike $like): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO posts_likes (uuid, post_uuid, author_uuid) VALUES (:uuid, :post_uuid, :author_uuid)'
        );
        $stmt->execute([
            'uuid' => $like->id,
            'post_uuid' => $like->postId,
            'author_uuid' => $like->authorId,
        ]);

        $this->logger->info('PostLike saved', ['uuid' => $like->id]);
    }

    public function getByPostUuid(string $postUuid): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM posts_likes WHERE post_uuid = :post_uuid');
        $stmt->execute(['post_uuid' => $postUuid]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new Exception("PostLikes with uuid $postUuid not found");
            $this->logger->warning('No postLikes found', ['postUuid' => $postUuid]);
        }
        return $result;
    }

    public function saveCommentLike(CommentLike $like): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO comments_likes (uuid, comment_uuid, author_uuid) VALUES (:uuid, :comment_uuid, :author_uuid)'
        );
        $stmt->execute([
            'uuid' => $like->id,
            'comment_uuid' => $like->commentId,
            'author_uuid' => $like->authorId,
        ]);

        $this->logger->info('CommentLike saved', ['uuid' => $like->id]);
    }

    public function getByCommentUuid(string $commentUuid): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM comments_likes WHERE comment_uuid = :comment_uuid');
        $stmt->execute(['comment_uuid' => $commentUuid]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new Exception("CommentLikes with uuid $commentUuid not found");
            $this->logger->warning('No commentLikes found', ['commentUuid' => $commentUuid]);
        }
        return $result;
    }
}
