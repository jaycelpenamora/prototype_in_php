<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, TransactionService};

class TransactionController
{
  public function __construct(
    private TemplateEngine $view,
    private ValidatorService $validatorService,
    private TransactionService $transactionService
  ) {
  }

  public function createView(): void
  {
    $movies = $this->transactionService->getMovies();

    // dd($movies);
    echo $this->view->render("transactions/create.php", [
      'movies' => $movies
    ]);
  }

  public function create(): void
  {
    $this->transactionService->create($_POST);

    redirect('/');
  }

  // public function editView(array $params): void
  // {
  //   $transaction = $this->transactionService->getUserTransaction(
  //     $params['transaction']
  //   );
  //
  //   if (!$transaction) {
  //     redirect('/');
  //   }
  //
  //   echo $this->view->render('transactions/edit.php', [
  //     'transaction' => $transaction
  //   ]);
  // }

  // public function edit(array $params): void
  // {
  //   $transaction = $this->transactionService->getUserTransaction(
  //     $params['transaction']
  //   );
  //
  //   if (!$transaction) {
  //     redirect('/');
  //   }
  //
  //   // $this->validatorService->validateTransaction($_POST);
  //
  //   $this->transactionService->update($_POST, $transaction['id']);
  //
  //   redirect($_SERVER['HTTP_REFERER']);
  // }

  // public function delete(array $params): void
  // {
  //   $this->transactionService->delete((int) $params['transaction']);
  //
  //   redirect('/');
  // }
}
