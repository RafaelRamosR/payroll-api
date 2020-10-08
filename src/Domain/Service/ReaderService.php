<?php

namespace App\Domain\Service;

use App\Domain\Repository\CrudRepository;

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
   * Read data from a table.
   *
   * @param array $data The form data
   *
   * @return int The new user ID
   */
  public function readData(array $query, string $data): array
  {
    // Get all or a single field
    switch ($data) {
      case 'all':
        $result = $this->repository->getListAll($query);
        break;
      case 'details':
        $result = $this->repository->getListWithDetails($query);
        break;
      default:
        $result = $this->repository->getListOne($query, $data);
        break;
    }

    return $result;
  }
}
