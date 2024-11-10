<?php

namespace App\Controllers;

use PDO;
use App\Services\CreateLike;
use App\Repositories\LikesRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class LikesController
{
    private $createLikeService;

    public function __construct()
    {
        $this->createLikeService = new CreateLike(new LikesRepository(new PDO('sqlite:' . 'D:/Downloads/sqlite-tools-win-x64-3460100/mydb.db')));;
    }

    public function createPostLike(Request $request, Response $response): Response
    {
        $data = json_decode($request->getBody()->getContents(), true);

        if (empty($data)) {
            $result = [
                'status' => 'error',
                'message' => 'No data provided'
            ];

            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $result = $this->createLikeService->createPostLike($data);

        $response->getBody()->write(json_encode($result));

        if ($result['status'] === 'error') {
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function createCommentLike(Request $request, Response $response): Response
    {
        $data = json_decode($request->getBody()->getContents(), true);

        if (empty($data)) {
            $result = [
                'status' => 'error',
                'message' => 'No data provided'
            ];

            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $result = $this->createLikeService->createCommentLike($data);

        $response->getBody()->write(json_encode($result));

        if ($result['status'] === 'error') {
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
