<?php

namespace App\Aplication\Action\Pet;

use App\Domain\Service\CreatorService;
use App\Aplication\Action\Pet\Pet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateAction
{
  /**
   * @var creatorService
   */
  private $creatorService;
  private $pet;

  /**
   * The constructor.
   *
   * @param creatorService $creatorService The user creator
   */
  public function __construct(CreatorService $creatorService, Pet $pet)
  {
    $this->creatorService = $creatorService;
    $this->pet = $pet;
  }

  /**
   * Invoke.
   *
   * @param ServerRequestInterface $req The request
   * @param ResponseInterface $res The response
   *
   * @return ResponseInterface The response
   */
  public function __invoke(ServerRequestInterface $req, ResponseInterface $res): ResponseInterface
  {
    // Collect input from the HTTP request
    $data = (array)$req->getParsedBody();
    $this->pet->validateData($data);
    $query = $this->pet->query;

    // Invoke the Domain with inputs and retain the result
    $result = $this->creatorService->createData($query, $data);

    // Build the HTTP response
    $res->getBody()->write((string)json_encode($result));
    return $res->withHeader('Content-Type', 'application/json')->withStatus(201);
  }
}
