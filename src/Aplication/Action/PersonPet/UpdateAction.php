<?php

namespace App\Aplication\Action\PersonPet;

use App\Domain\Service\UpdaterService;
use App\Aplication\Action\PersonPet\PersonPet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UpdateAction
{
  private $updaterService;
  private $personPet;

  public function __construct(UpdaterService $updaterService, PersonPet $personPet)
  {
    $this->updaterService = $updaterService;
    $this->personPet = $personPet;
  }

  public function __invoke(ServerRequestInterface $req, ResponseInterface $res): ResponseInterface
  {
    $data = (array)$req->getParsedBody();
    $this->personPet->validateData($data);
    $query = $this->personPet->query;

    $result = $this->updaterService->updateData($query, $data);

    $res->getBody()->write((string)json_encode($result));
    return $res->withHeader('Content-Type', 'application/json')->withStatus(201);
  }
}
