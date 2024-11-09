<?php

namespace App\Services;

use App\Repositories\CommentsRepository;
use App\Models\Comment;
use Exception;
use Ramsey\Uuid\Uuid;

class CreateComment
{
    private CommentsRepository $repository;

    public function __construct(CommentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): array
    {
        if (empty($data['author_uuid']) || empty($data['post_uuid']) || empty($data['text'])) {
            return ['status' => 'error', 'message' => 'Missing required data'];
        }

        if (!Uuid::isValid($data['author_uuid']) || !Uuid::isValid($data['post_uuid'])) {
            return ['status' => 'error', 'message' => 'Invalid UUID format'];
        }

        try {
            $comment = new Comment(Uuid::uuid4(), $data['author_uuid'], $data['post_uuid'], $data['text']);
            $this->repository->save($comment);
            return ['status' => 'success', 'message' => 'Comment added'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => 'Error saving comment'];
        }
    }
}
