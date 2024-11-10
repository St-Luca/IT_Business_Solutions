<?php

namespace App\Services;

use App\Models\CommentLike;
use App\Repositories\LikesRepository;
use App\Models\PostLike;
use Ramsey\Uuid\Uuid;
use Exception;

class CreateLike
{
    private LikesRepository $repository;

    public function __construct(LikesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createPostLike(array $data): array
    {
        if (empty($data['author_uuid']) || empty($data['post_uuid'])) {
            return ['status' => 'error', 'message' => 'Missing required data'];
        }

        if (!Uuid::isValid($data['author_uuid']) || !Uuid::isValid($data['post_uuid'])) {
            return ['status' => 'error', 'message' => 'Invalid UUID format'];
        }

        try {
            $postLike = new PostLike(Uuid::uuid4(), $data['post_uuid'], $data['author_uuid']);
            $this->repository->savePostLike($postLike);
            return ['status' => 'success', 'message' => 'PostLike created'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => 'Error saving postLike'];
        }
    }

    public function createCommentLike(array $data): array
    {
        if (empty($data['author_uuid']) || empty($data['comment_uuid'])) {
            return ['status' => 'error', 'message' => 'Missing required data'];
        }

        if (!Uuid::isValid($data['author_uuid']) || !Uuid::isValid($data['comment_uuid'])) {
            return ['status' => 'error', 'message' => 'Invalid UUID format'];
        }

        try {
            $commentLike = new CommentLike(Uuid::uuid4(), $data['comment_uuid'], $data['author_uuid']);
            $this->repository->saveCommentLike($commentLike);
            return ['status' => 'success', 'message' => 'CommentLike created'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => 'Error saving commentLike'];
        }
    }
}
