<?php

namespace App\Aplication\Action\Pet;

use App\Aplication\lib\Validate;
use App\Exception\ValidationException;

final class Pet
{
  private $validate;
  public $query = [
    'table' => 'pets',
    'columns' => 'name=:name, age=:age'
  ];

  public function __construct(Validate $validate)
  {
    $this->validate = $validate;
  }

  public function validateData(array $data)
  {
    $errors = [];
    if ($data['id'] && !$this->validate->obligatory($data['id'])) {
      $errors['id'] = 'Input required';
    }

    if (!$this->validate->obligatory($data['name'])) {
      $errors['name'] = 'Input required';
    }

    if (!$this->validate->number($data['age'], 1, 3)) {
      $errors['age'] = 'Age does not accomplish the requirements';
    }

    if ($errors) {
      throw new ValidationException('Please check your input', $errors);
    }
  }

  public function validateId(int $id)
  {
    $errors = [];
    if (!$this->validate->number($id, 1, 11)) {
      $errors['id'] = 'ID is not a number';
    }

    if ($errors) {
      throw new ValidationException('Please check your input', $errors);
    }
  }
}
