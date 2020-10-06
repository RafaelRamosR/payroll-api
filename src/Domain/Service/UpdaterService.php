<?php

namespace App\Domain\Service;

use App\Domain\Repository\CrudRepository;

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
    // Update field
    $userId = $this->repository->update($data);

    return $userId;
  }
}
