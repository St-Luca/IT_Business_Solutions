<?php

use PHPUnit\Framework\TestCase;
use App\Models\Comment;
use App\Repositories\CommentsRepository;


class CommentsRepositoryTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        $dsn = 'sqlite:' . 'D:/Downloads/sqlite-tools-win-x64-3460100/mydb.db';
        $this->repository = new CommentsRepository(new PDO($dsn));
    }

    public function testSaveComment(): void
    {
        $comment = new Comment('uuid-comment-1', 'uuid-author-1', 'uuid-post-1', 'Comment text 1');

        try {
            $this->repository->save($comment);
        } catch (Exception $e) {
        }

        $retrievedComment = $this->repository->get('uuid-comment-1');
        $this->assertEquals($comment, $retrievedComment);
    }

    public function testGetCommentByUuid(): void
    {
        $comment = new Comment('uuid-comment-2', 'uuid-author-2', 'uuid-post-2', 'Comment text 2');

        try {
            $this->repository->save($comment);
        } catch (Exception $e) {
        }

        $retrievedComment = $this->repository->get('uuid-comment-2');
        $this->assertNotNull($retrievedComment);
        $this->assertSame('Comment text 2', $retrievedComment->text);
    }

    public function testGetNonExistentCommentThrowsException(): void
    {
        $this->expectException(Exception::class);
        $this->repository->get('non-existent-uuid');
    }
}
