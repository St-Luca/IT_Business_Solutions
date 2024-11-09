<?php

use PHPUnit\Framework\TestCase;
use App\Models\Post;

class PostTest extends TestCase
{
    public function testPostConstructorSetsProperties(): void
    {
        $post = new Post('post-id', 'author-id', 'Post Title', 'This is a post text.');

        $this->assertEquals('post-id', $post->id);
        $this->assertEquals('author-id', $post->authorId);
        $this->assertEquals('Post Title', $post->title);
        $this->assertEquals('This is a post text.', $post->text);
    }
}
