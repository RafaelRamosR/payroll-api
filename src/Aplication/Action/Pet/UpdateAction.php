<?php

namespace App\Aplication\Action\Pet;

use App\Domain\Service\UpdaterService;
use App\Aplication\Action\Pet\Pet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UpdateAction
{
  private $updaterService;
  private $pet;

  public function __construct(UpdaterService $updaterService, Pet $pet)
  {
    $this->updaterService = $updaterService;
    $this->pet = $pet;
  }

  public function __invoke(ServerRequestInterface $req, ResponseInterface $res): ResponseInterface
  {
    $data = (array)$req->getParsedBody();
    $this->pet->validateData($data);
    $query = $this->pet->query;

    $result = $this->updaterService->updateData($query, $data);

    $res->getBody()->write((string)json_encode($result));
    return $res->withHeader('Content-Type', 'application/json')->withStatus(201);
  }
}
