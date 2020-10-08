<?php

namespace App\Aplication\Action\PersonPet;

use App\Domain\Service\ReaderService;
use App\Aplication\Action\PersonPet\PersonPet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ReadAction
{
  private $readerService;
  private $personPet;

  public function __construct(ReaderService $readerService, PersonPet $personPet)
  {
    $this->readerService = $readerService;
    $this->personPet = $personPet;
  }

  public function __invoke(
    ServerRequestInterface $req,
    ResponseInterface $res,
    array $args
  ): ResponseInterface {
    // Collect input from the arguments array
    $data = $args['data'];
    $query = $this->personPet->query;

    // Invoke the Domain with inputs and retain the result
    $result = $this->readerService->readData($query, $data);

    $res->getBody()->write((string)json_encode($result));
    return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
  }
}
