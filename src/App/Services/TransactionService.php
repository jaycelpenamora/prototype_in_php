<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
  public function __construct(private Database $db) {}

  // public function create(array $formData): void
  // {
  //
  //   $currentDate = new \DateTime();
  //   $currentDate->modify('+1 month');
  //   $dueDate = $currentDate->format('Y-m-d');
  //   // $this->db->query(
  //   //   "INSERT INTO transactions(user_id, description, amount, date)
  //   //   VALUES(:user_id, :description, :amount, :date)",
  //   //   [
  //   //     'user_id' => $_SESSION['user'],
  //   //     'description' => $formData['description'],
  //   //     'amount' => $formData['amount'],
  //   //     'date' => $formattedDate
  //   //   ]
  //   // );
  // }

  // public function getUserTransactions(int $length, int $offset): array
  // {
  //   $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
  //   $params = [
  //     'user_id' => $_SESSION['user'],
  //     'description' => "%{$searchTerm}%"
  //   ];
  //
  //   $transactions = $this->db->query(
  //     "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') as formatted_date
  //     FROM transactions 
  //     WHERE user_id = :user_id
  //     AND description LIKE :description
  //     LIMIT {$length} OFFSET {$offset}",
  //     $params
  //   )->findAll();
  //
  //   $transactions = array_map(function (array $transaction) {
  //     $transaction['receipts'] = $this->db->query(
  //       "SELECT * FROM receipts WHERE rental_id = :rental_id",
  //       ['rental_id' => $transaction['id']]
  //     )->findAll();
  //
  //     return $transaction;
  //   }, $transactions);
  //
  //   $transactionCount = $this->db->query(
  //     "SELECT COUNT(*)
  //     FROM transactions 
  //     WHERE user_id = :user_id
  //     AND description LIKE :description",
  //     $params
  //   )->count();
  //
  //   return [$transactions, $transactionCount];
  // }


  // public function update(array $formData, int $id): void
  // {
  //   $formattedDate = "{$formData['date']} 00:00:00";
  //
  //   $this->db->query(
  //     "UPDATE transactions
  //     SET description = :description,
  //       amount = :amount,
  //       date = :date
  //     WHERE id = :id
  //     AND user_id = :user_id",
  //     [
  //       'description' => $formData['description'],
  //       'amount' => $formData['amount'],
  //       'date' => $formattedDate,
  //       'id' => $id,
  //       'user_id' => $_SESSION['user']
  //     ]
  //   );
  // }

  // public function delete(int $id): void
  // {
  //   $this->db->query(
  //     "DELETE FROM transactions WHERE id = :id AND user_id = :user_id",
  //     [
  //       'id' => $id,
  //       'user_id' => $_SESSION['user']
  //     ]
  //   );
  // }

  public function getMovies(): mixed
  {
    return $this->db->query("SELECT *, DATE_FORMAT(release_date, '%Y-%m-%d') as formatted_date FROM movies_T")->findAll();
  }

  public function getRentals(int $length, int $offset)
  {
    $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
    $params = [
      'user_id' => $_SESSION['user_id'],
      'title' => "%{$searchTerm}%"
    ];

    $rentals = $this->db->query(
      "SELECT
      rentals.rental_id,
      rentals.user_id,
      rentals.movie_id,
      rentals.issued_date,
      rentals.due_date,
      rentals.return_date,
      movies.title AS title,
      movies.rental_price AS rental_price
      FROM
      rentals_T AS rentals
      INNER JOIN
      movies_T AS movies ON rentals.movie_id = movies.movie_id
      WHERE
      rentals.user_id = :user_id
      AND movies.title LIKE :title",
      $params
    )->findAll();

    $rentals = array_map(function (array $rentals) {
      $rentals['receipts'] = $this->db->query(
        "SELECT * FROM rentals_T WHERE rental_id = :rental_id",
        ['rental_id' => $rentals['rental_id']]
      )->findAll();

      return $rentals;
    }, $rentals);

    $rentalsCount = $this->db->query(
      "SELECT COUNT(*) AS rentals_count
      FROM rentals_T AS rentals
      INNER JOIN movies_T AS movies ON rentals.movie_id = movies.movie_id
      WHERE rentals.user_id = :user_id
      AND movies.title LIKE :title",
      $params
    )->count();

    return [$rentals, $rentalsCount];
  }
}
