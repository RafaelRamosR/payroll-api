<?php

namespace App\Domain\Repository;

use PDO;

class CrudRepository
{
  /**
   * @var PDO The database connection
   */
  private $connection;

  /**
   * Constructor.
   *
   * @param PDO $connection The database connection
   */
  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  /**
   * Select a row.
   *
   * @param int $id Row id
   *
   * @return array Array with all the data in the row
   */
  public function getListOne(array $query, int $id): array
  {
    $table = $query['table'];
    $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    return (array)$stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Select all rows.
   *
   * @return array Array with all table data
   */
  public function getListAll($query): array
  {
    $table = $query['table'];
    $sql = "SELECT * FROM " . $table;
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    return (array)$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Select all rows.
   *
   * @return array Array with all table data
   */
  public function getListWithDetails($query): array
  {
    $table = $query['table'];
    $columns = $query['mergedColumns'];
    $join = $query['join'];
    $condition = $query['condition'];
    $sql = "SELECT $columns FROM $table $join WHERE TRUE $condition";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    return (array)$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Insert row.
   *
   * @param array $data Values to insert
   *
   * @return int The last ID
   */
  public function create(array $query, array $data): int
  {
    $table = $query['table'];
    $columns = $query['columns'];
    $sql = "INSERT INTO " . $table . " SET " . $columns;
    $this->connection->prepare($sql)->execute($data);
    return (int)$this->connection->lastInsertId();
  }

  /**
   * Update row.
   *
   * @param array $data Values to update
   *
   * @return int The update ID
   */
  public function update(array $query, array $data): int
  {
    $table = $query['table'];
    $columns = $query['columns'];
    $sql = "UPDATE " . $table . " SET " . $columns . " WHERE id = :id";

    $this->connection->prepare($sql)->execute($data);
    return (int)$this->connection->lastInsertId();
  }

  /**
   * Delete row.
   *
   * @param int $id ID of the row to delete
   *
   * @return int The deleted ID
   */
  public function delete(array $query, int $id): int
  {
    $table = $query['table'];
    $sql = "DELETE FROM " . $table . " WHERE id  = " . $id;
    $this->connection->prepare($sql)->execute();
    return $id;
  }
}
