<?php

namespace App\Domain\Person;

use App\Domain\User\Service\CreatorService;
use App\Action\ReadAction;
use App\Action\UpdateAction;
use App\Action\DeleteAction;
use App\Aplication\lib\Validate;
use App\Exception\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Person
{
  /**
   * @var Validate
   */
  private $validate;
  private $creator;

  /**
   * The constructor.
   *
   * @param Validate $validate The validate
   */
  public function __construct(Validate $validate, CreatorService $creator)
  {
    $this->validate = $validate;
    $this->creator = $creator;
  }

  public function createData(ServerRequestInterface $request, ResponseInterface $response)
  {
    // Collect input from the HTTP request
    $data = (array)$request->getParsedBody();
    $this->validateData($data);

    // Invoke the Domain with inputs and retain the result
    $userId = $this->creator->createData($data);

    // Transform the result into the JSON representation
    $result = [
      'user_id' => $userId
    ];

    // Build the HTTP response
    $response->getBody()->write((string)json_encode($result));

    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(201);
  }

  public function readData(int $id)
  {
    return $this->validateData(array($id));
  }

  public function updateData(array $data)
  {
    return $this->validateData($data);
  }

  public function deleteData(int $id)
  {
    return $this->validateData(array($id));
  }

  private function validateData(array $data)
  {
    $errors = [];

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
}
