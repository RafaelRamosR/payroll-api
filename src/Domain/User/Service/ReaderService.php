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
   * Read data from a table.
   *
   * @param array $data The form data
   *
   * @return int The new user ID
   */
  public function readData(string $data):array
  {
    // Get all or a single field
    $userId = $data === 'all' 
    ? $this->repository->getListAll() 
    : $userId = $this->repository->getListOne($data);

    return $userId;
  }
}
