<?php

namespace App\Domain\Service;

use App\Domain\Repository\CrudRepository;

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
  public function createData(array $query, array $data): int
  {
    // Insert user
    //$this->repository->setQuery($query);
    $userId = $this->repository->create($query, $data);

    return $userId;
  }
}
