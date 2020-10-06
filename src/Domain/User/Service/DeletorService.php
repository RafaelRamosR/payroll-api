<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\CrudRepository;

/**
 * Service.
 */
final class DeletorService
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
   * Delete a new field.
   *
   * @param array $data The form data
   *
   * @return int The last deleted ID
   */
  public function deleteData(int $data): int
  {
    // Delete field
    $userId = $this->repository->delete($data);

    return $userId;
  }
}
