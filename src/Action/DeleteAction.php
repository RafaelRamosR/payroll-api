<?php

namespace App\Action;

use App\Domain\User\Service\EliminatorService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteAction
{
  private $eliminator;

  public function __construct(EliminatorService $eliminator)
  {
    $this->eliminator = $eliminator;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response,
    $args
  ): ResponseInterface {
    // Collect input from the HTTP request
    //$data = (int)$request->getParsedBody();
    $data = $args['id'];
    // Invoke the Domain with inputs and retain the result
    $userId = $this->eliminator->deleteData($data);

    // Transform the result into the JSON representation
    $result = [
      'user_id' => $userId
    ];

    // Build the HTTP response
    $response->getBody()->write((string)json_encode($result));

    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(201);
  }
}
