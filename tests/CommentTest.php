<?php

use PHPUnit\Framework\TestCase;
use App\Models\Comment;

class CommentTest extends TestCase
{
    public function testCommentConstructorSetsProperties(): void
    {
        $comment = new Comment('comment-id', 'author-id', 'post-id', 'This is a comment text.');

        $this->assertEquals('comment-id', $comment->id);
        $this->assertEquals('author-id', $comment->authorId);
        $this->assertEquals('post-id', $comment->postId);
        $this->assertEquals('This is a comment text.', $comment->text);
    }
}
