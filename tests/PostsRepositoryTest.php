<?php

use PHPUnit\Framework\TestCase;
use App\Models\Post;
use App\Repositories\PostsRepository;

class PostsRepositoryTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        $dsn = 'sqlite:' . 'D:/Downloads/sqlite-tools-win-x64-3460100/mydb.db';
        $this->repository = new PostsRepository(new PDO($dsn));
    }

    public function testSavePost(): void
    {
        $post = new Post('uuid-post-1', 'uuid-author-1', 'Title 1', 'Text 1');

        try {
            $this->repository->save($post);
        } catch (Exception $e) {
        }

        $retrievedPost = $this->repository->get('uuid-post-1');
        $this->assertEquals($post, $retrievedPost);
    }

    public function testGetPostByUuid(): void
    {
        $post = new Post('uuid-post-2', 'uuid-author-2', 'Title 2', 'Text 2');

        try {
            $this->repository->save($post);
        } catch (Exception $e) {
        }

        $retrievedPost = $this->repository->get('uuid-post-2');
        $this->assertNotNull($retrievedPost);
        $this->assertSame('Title 2', $retrievedPost->title);
    }

    public function testGetNonExistentPostThrowsException(): void
    {
        $this->expectException(Exception::class);
        $this->repository->get('non-existent-uuid');
    }
}
