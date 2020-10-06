<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\CrudRepository;

/**
 * Service.
 */
final class CreatorService
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
   * Create a new data.
   *
   * @param array $data The form data
   *
   * @return int The new data ID
   */
  public function createData(array $data): int
  {
    // Insert user
    $userId = $this->repository->create($data);

    return $userId;
  }
}
