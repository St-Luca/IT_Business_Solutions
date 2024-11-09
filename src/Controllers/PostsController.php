<?php

namespace App\Controllers;

use PDO;
use App\Services\DeletePost;
use App\Repositories\PostsRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PostsController
{
    private $deletePostService;

    public function __construct()
    {
        $this->deletePostService = new DeletePost(new PostsRepository(new PDO('sqlite:' . 'D:/Downloads/sqlite-tools-win-x64-3460100/mydb.db')));
    }

    public function deletePost(Request $request, Response $response): Response
    {
        $uuid = $request->getQueryParams()['uuid'] ?? null;

        if (!$uuid) {
            $result = ['status' => 'error', 'message' => 'UUID is required'];
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $result = $this->deletePostService->delete($uuid);

        if ($result['status'] === 'error') {
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
