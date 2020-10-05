<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\CrudRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class UpdaterService
{
  /**
   * @var CrudRepository
   */
  private $repository;

  /**
   * The constructor.
   *
   * @param CrudRepository $repository The repository
   */
  public function __construct(CrudRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Update a field.
   *
   * @param array $data The form data
   *
   * @return int The last updated ID
   */
  public function updateData(array $data): int
  {
    // Input validation
    $this->validateNewUser($data);

    // Update field
    $userId = $this->repository->update($data);

    return $userId;
  }

  /**
   * Input validation.
   *
   * @param array $data The form data
   *
   * @throws ValidationException
   *
   * @return void
   */
  private function validateNewUser(array $data): void
  {
    $errors = [];

    // Here you can also use your preferred validation library

    if (empty($data['username'])) {
      $errors['username'] = 'Input required';
    }

    if (empty($data['email'])) {
      $errors['email'] = 'Input required';
    } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
      $errors['email'] = 'Invalid email address';
    }

    if ($errors) {
      throw new ValidationException('Please check your input', $errors);
    }
  }
}
