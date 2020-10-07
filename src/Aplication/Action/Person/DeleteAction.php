<?php

namespace App\Aplication\Action\Person;

use App\Domain\Service\DeletorService;
use App\Aplication\Action\Person\Person;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteAction
{
  private $deletorService;
  private $person;

  public function __construct(DeletorService $deletorService, Person $person)
  {
    $this->deletorService = $deletorService;
    $this->person = $person;
  }

  public function __invoke(
    ServerRequestInterface $req, 
    ResponseInterface $res, 
    Array $args): ResponseInterface
  {
    // Collect input from the arguments array
    $id = $args['id'];
    $this->person->validateId($id);
    $query = $this->person->query;

    $result = $this->deletorService->deleteData($query, $id);

    $res->getBody()->write((string)json_encode($result));
    return $res->withHeader('Content-Type', 'application/json')->withStatus(201);
  }
}
