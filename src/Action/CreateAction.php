<?php

namespace App\Action;

use App\Domain\User\Service\CreatorService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateAction
{
  private $creator;

  public function __construct(CreatorService $creator)
  {
    $this->creator = $creator;
  }

  public function __invoke(
    array $data,
    ResponseInterface $response
  ): ResponseInterface {

    // Invoke the Domain with inputs and retain the result
    $userId = $this->creator->createData($data);

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
