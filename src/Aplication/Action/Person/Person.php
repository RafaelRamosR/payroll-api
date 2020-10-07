<?php

namespace App\Aplication\Action\Person;

use App\Domain\Service\ReaderService;
use App\Aplication\lib\Validate;
use App\Exception\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Person
{
  private $validate;
  private $reader;
  public $query = [
    'table' => 'users', 
    'columns' => 'username=:username, first_name=:first_name, last_name=:last_name, email=:email'
  ];

  public function __construct(
    Validate $validate,
    ReaderService $reader
  ) {
    $this->validate = $validate;
    $this->reader = $reader;
  }

  public function readData(ServerRequestInterface $request, ResponseInterface $response, array $args)
  {
    // Collect input from the arguments array
    $data = $args['data'];
    $this->validate->alphanumeric($data, 1, 11);

    // Invoke the Domain with inputs and retain the result
    $result = $this->reader->readData($this->query, $data);

    // Build the HTTP response
    $response->getBody()->write((string)json_encode($result));

    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);
  }

  public function validateData(array $data)
  {
    $errors = [];
    if ($data['id'] && !$this->validate->obligatory($data['id'])) {
      $errors['id'] = 'Input required';
    }

    if (!$this->validate->obligatory($data['username'])) {
      $errors['username'] = 'Input required';
    }

    if (!$this->validate->text($data['first_name'], 3, 20)) {
      $errors['first_name'] = 'Firs name does not accomplish the requirements';
    }

    if (!$this->validate->text($data['last_name'], 3, 20)) {
      $errors['last_name'] = 'Last name does not accomplish the requirements';
    }

    if (!$this->validate->email($data['email'], 10, 30)) {
      $errors['email'] = 'Email does not accomplish the requirements';
    }

    if ($errors) {
      throw new ValidationException('Please check your input', $errors);
    }
  }

  public function validateId(int $id)
  {
    $errors = [];
    if (!$this->validate->obligatory($id)) {
      $errors['id'] = 'Input required';
    }

    if ($errors) {
      throw new ValidationException('Please check your input', $errors);
    }
  }
}
