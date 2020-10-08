<?php

namespace App\Aplication\Action\Pet;

use App\Domain\Service\DeletorService;
use App\Aplication\Action\Pet\Pet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteAction
{
  private $deletorService;
  private $pet;

  public function __construct(DeletorService $deletorService, Pet $pet)
  {
    $this->deletorService = $deletorService;
    $this->pet = $pet;
  }

  public function __invoke(
    ServerRequestInterface $req,
    ResponseInterface $res,
    array $args
  ): ResponseInterface {
    // Collect input from the arguments array
    $id = $args['id'];
    $this->pet->validateId($id);
    $query = $this->pet->query;

    $result = $this->deletorService->deleteData($query, $id);

    $res->getBody()->write((string)json_encode($result));
    return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
  }
}
