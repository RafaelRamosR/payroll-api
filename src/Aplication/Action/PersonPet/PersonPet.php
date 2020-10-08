<?php

namespace App\Aplication\Action\PersonPet;

use App\Aplication\lib\Validate;
use App\Exception\ValidationException;

final class PersonPet
{
  private $validate;
  public $query = [
    "table" => "user_pets",
    "columns" => "id_user=:id_user, id_pet=:id_pet",
    "mergedColumns" => "user_pets.id, CONCAT_WS(' ', u.first_name, u.last_name) AS name, p.name AS pet",
    "join" => "INNER JOIN users u ON user_pets.id_user = u.id INNER JOIN pets p ON user_pets.id_pet = p.id",
    "condition" => ""
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

    if (!$this->validate->obligatory($data['id_user'])) {
      $errors['id_user'] = 'Input required';
    }

    if (!$this->validate->obligatory($data['id_pet'])) {
      $errors['id_pet'] = 'Input required';
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
