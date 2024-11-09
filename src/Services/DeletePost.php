<?php

namespace App\Services;

use App\Repositories\PostsRepository;
use Exception;

class DeletePost
{
    private PostsRepository $repository;

    public function __construct(PostsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete(string $uuid): array
    {
        try {
            $this->repository->delete($uuid);
            return ['status' => 'success', 'message' => 'Post deleted'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
