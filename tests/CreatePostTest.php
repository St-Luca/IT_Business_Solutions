<?php

use PHPUnit\Framework\TestCase;
use App\Services\CreatePost;
use App\Repositories\PostsRepository;
use Ramsey\Uuid\Uuid;

class CreatePostServiceTest extends TestCase
{
    private $service;
    private $repository;

    protected function setUp(): void
    {
        $dsn = 'sqlite:' . 'D:/Downloads/sqlite-tools-win-x64-3460100/mydb.db';
        $this->repository = new PostsRepository(new PDO($dsn));

        $this->service = new CreatePost($this->repository);
    }

    public function testReturnsSuccessResponse(): void
    {
        $data = ['author_uuid' => Uuid::uuid4(), 'title' => 'My Post', 'text' => 'Post content'];

        $result = $this->service->create($data);
        $this->assertEquals('success', $result['status']);
    }

    public function testReturnsErrorForInvalidUUIDFormat(): void
    {
        $data = ['author_uuid' => 'invalid-uuid', 'title' => 'My Post', 'text' => 'Post content'];

        $result = $this->service->create($data);
        $this->assertEquals('error', $result['status']);
        $this->assertEquals('Invalid UUID format', $result['message']);
    }

    public function testReturnsErrorWhenDataIsMissing(): void
    {
        $data = ['author_uuid' => 'uuid-author-1', 'text' => 'Post content'];

        $result = $this->service->create($data);
        $this->assertEquals('error', $result['status']);
        $this->assertEquals('Missing required data', $result['message']);
    }
}
