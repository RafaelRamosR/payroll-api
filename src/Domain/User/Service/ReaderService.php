<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\CrudRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class ReaderService
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
   * Create a new user.
   *
   * @param array $data The form data
   *
   * @return int The new user ID
   */
  public function readData(string $data):array
  {
    // Input validation
    //$this->validateNewUser($data);

    // Insert user
    $userId = $data === 'all' 
    ? $this->repository->getListAll() 
    : $userId = $this->repository->getListOne($data);

    // Logging here: User created successfully
    //$this->logger->info(sprintf('User created successfully: %s', $userId));

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
