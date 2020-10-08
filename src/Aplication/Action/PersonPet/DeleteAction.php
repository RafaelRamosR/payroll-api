<?php

namespace App\Aplication\Action\PersonPet;

use App\Domain\Service\DeletorService;
use App\Aplication\Action\PersonPet\PersonPet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteAction
{
  private $deletorService;
  private $personPet;

  public function __construct(DeletorService $deletorService, PersonPet $personPet)
  {
    $this->deletorService = $deletorService;
    $this->personPet = $personPet;
  }

  public function __invoke(
    ServerRequestInterface $req,
    ResponseInterface $res,
    array $args
  ): ResponseInterface {
    // Collect input from the arguments array
    $id = $args['id'];
    $this->personPet->validateId($id);
    $query = $this->personPet->query;

    $result = $this->deletorService->deleteData($query, $id);

    $res->getBody()->write((string)json_encode($result));
    return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
  }
}
