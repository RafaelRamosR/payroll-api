<?php

namespace App\Action;

use App\Domain\User\Service\UpdaterService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UpdateAction
{
  private $updater;

  public function __construct(UpdaterService $updater)
  {
    $this->updater = $updater;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response
  ): ResponseInterface {
    // Collect input from the HTTP request
    $data = (array)$request->getParsedBody();

    // Invoke the Domain with inputs and retain the result
    $userId = $this->updater->updateData($data);

    // Transform the result into the JSON representation
    $result = [
      'user_id' => $userId
    ];

    // Build the HTTP response
    $response->getBody()->write((string)json_encode($result));

    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);
  }
}
