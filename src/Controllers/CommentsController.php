<?php

namespace App\Controllers;

use PDO;
use App\Services\CreateComment;
use App\Repositories\CommentsRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class CommentsController
{
    private $createCommentService;

    public function __construct()
    {
        $this->createCommentService = new CreateComment(new CommentsRepository(new PDO('sqlite:' . 'D:/Downloads/sqlite-tools-win-x64-3460100/mydb.db')));
    }

    public function createComment(Request $request, Response $response): Response
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

        $result = $this->createCommentService->create($data);

        $response->getBody()->write(json_encode($result));

        if ($result['status'] === 'error') {
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
