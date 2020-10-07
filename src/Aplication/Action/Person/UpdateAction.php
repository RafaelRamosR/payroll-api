<?php

namespace App\Aplication\Action\Person;

use App\Domain\Service\UpdaterService;
use App\Aplication\Action\Person\Person;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UpdateAction
{
  private $updaterService;
  private $person;

  public function __construct(UpdaterService $updaterService, Person $person)
  {
    $this->updaterService = $updaterService;
    $this->person = $person;
  }

  public function __invoke(ServerRequestInterface $req, ResponseInterface $res): ResponseInterface
  {
    $data = (array)$req->getParsedBody();
    $this->person->validateData($data);
    $query = $this->person->query;

    $result = $this->updaterService->updateData($query, $data);

    $res->getBody()->write((string)json_encode($result));
    return $res->withHeader('Content-Type', 'application/json')->withStatus(201);
  }
}
