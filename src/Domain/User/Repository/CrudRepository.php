<?php

namespace App\Domain\User\Repository;

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

  public function getListOne($id): array
  {
    $query = [
      'table' => 'users'
    ];
    $table = $query['table'];
    $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    return (array)$stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getListAll(): array
  {
    $query = [
      'table' => 'users'
    ];
    $table = $query['table'];
    $sql = "SELECT * FROM " . $table;
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    return (array)$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function create(array $data): int
  {
    $query = [
      'table' => 'users',
      'columns' => 'username=:username, first_name=:first_name, last_name=:last_name, email=:email',
      'columns2' => 'username = ?, first_name = ?, last_name = ?, email = ?'
    ];
    $table = $query['table'];
    $columns = $query['columns'];
    //$sql = "INSERT INTO " . $table . " (" . $columns . ") VALUES (?, ?, ?, ?)";
    $sql = "INSERT INTO " . $table . " SET " . $columns;
    $this->connection->prepare($sql)->execute($data);
    return (int)$this->connection->lastInsertId();
  }

  public function update($data)
  {
    $query = [
      'table' => 'users',
      'columns' => 'username=:username, first_name=:first_name, last_name=:last_name, email=:email',
      'columns2' => 'username = ?, first_name = ?, last_name = ?, email = ?'
    ];
    $table = $query['table'];
    $columns = $query['columns'];
    $sql = "UPDATE " . $table . " SET " . $columns . " WHERE id = :id";

    $this->connection->prepare($sql)->execute($data);
    return (int)$this->connection->lastInsertId();
  }

  public function delete($id): int
  {
    $query = [
      'table' => 'users'
    ];
    $table = $query['table'];
    $sql = "DELETE FROM " . $table . " WHERE id  = " . $id;
    $this->connection->prepare($sql)->execute();
    return 28;
  }
}
