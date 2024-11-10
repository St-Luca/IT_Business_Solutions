<?php

require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use App\Controllers\CommentsController;
use App\Controllers\LikesController;
use App\Controllers\PostsController;

$app = AppFactory::create();

$app->post('/posts/comment', [CommentsController::class, 'createComment']);
$app->delete('/posts', [PostsController::class, 'deletePost']);

$app->post('/posts/like', [LikesController::class, 'createPostLike']);
$app->post('/comments/like', [LikesController::class, 'createCommentLike']);

$app->run();
