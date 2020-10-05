<?php

namespace App\Action;

use App\Domain\User\Service\ReaderService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ReadAction
{
  private $reader;

  public function __construct(ReaderService $reader)
  {
    $this->reader = $reader;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response,
    $args
  ): ResponseInterface {
    // Collect input from the HTTP request
    //$data = (array)$request->getParsedBody();
    $data = $args['data'];

    // Invoke the Domain with inputs and retain the result
    $result = $this->reader->readData($data);

    // Transform the result into the JSON representation
    //$result = ['user_id' => $userId ];

    // Build the HTTP response
    $response->getBody()->write((string)json_encode($result));

    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(201);
  }
}
