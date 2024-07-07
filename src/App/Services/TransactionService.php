<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
  public function __construct(private Database $db) {}

  public function add(array $params): void
  {
    $this->db->query(
      "INSERT INTO rentals_T(user_id, movie_id, issued_date, due_date) 
      VALUES(:user_id, :movie_id, :issued_date, :due_date)",
      [
        'user_id' => $_SESSION['user_id'],
        'movie_id' => $params['movie_id'],
        'issued_date' => date('Y-m-d'),
        'due_date' => date('Y-m-d', strtotime('+1 month'))
      ]
    );
  }

  public function getMovies(int $length, int $offset)
  {
    $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
    $params = [
      'title' => "%{$searchTerm}%"
    ];

    $results = $this->db->query(
      "SELECT *,DATE_FORMAT(release_date, '%Y') AS release_date
      FROM movies_T
      WHERE
      movies_T.title LIKE :title
      LIMIT {$length} OFFSET {$offset}",
      $params
    )->findAll();

    $results = array_map(function (array $result) {
      $result['movies'] = $this->db->query(
        "SELECT * FROM movies_T WHERE movie_id = :movie_id",
        ['movie_id' => $result['movie_id']]
      )->findAll();
      return $result;
    }, $results);

    $resultsCount = $this->db->query(
      "SELECT COUNT(*) AS results_count
      FROM movies_T
      WHERE movies_T.title LIKE :title",
      $params
    )->count();

    return [$results, $resultsCount];
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
      movies.rental_price AS rental_price,
      movies.genre AS genre
      FROM
      rentals_T AS rentals
      INNER JOIN
      movies_T AS movies ON rentals.movie_id = movies.movie_id
      WHERE
      rentals.user_id = :user_id
      AND movies.title LIKE :title
      LIMIT {$length} OFFSET {$offset}",
      $params
    )->findAll();

    $rentals = array_map(function (array $rentals) {
      $rentals['rentals'] = $this->db->query(
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

  public function delete(string $rental_id): void
  {
    $this->db->query(
      "DELETE FROM rentals_T WHERE rental_id = :rental_id AND user_id = :user_id",
      [
        'rental_id' => $rental_id,
        'user_id' => $_SESSION['user_id']
      ]
    );
  }
}
