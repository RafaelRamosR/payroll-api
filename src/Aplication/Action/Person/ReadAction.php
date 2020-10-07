<?php

namespace App\Aplication\Action\Person;

use App\Domain\Service\ReaderService;
use App\Aplication\Action\Person\Person;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ReadAction
{
  private $readerService;
  private $person;

  public function __construct(ReaderService $readerService, Person $person)
  {
    $this->readerService = $readerService;
    $this->person = $person;
  }

  public function __invoke(
    ServerRequestInterface $req,
    ResponseInterface $res,
    array $args
  ): ResponseInterface {
    // Collect input from the arguments array
    $data = $args['data'];
    $query = $this->person->query;

    // Invoke the Domain with inputs and retain the result
    $result = $this->readerService->readData($query, $data);

    $res->getBody()->write((string)json_encode($result));
    return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
  }
}
