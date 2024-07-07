<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\TransactionService;

class HomeController
{

    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService
    ) {}

    public function home(): void
    {
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 4;
        $offset = ($page - 1) * $length;
        $searchTerm = $_GET['s'] ?? null;

        [$results, $count] = $this->transactionService->getRentals(
            $length,
            $offset
        );
        $lastPage = ceil($count / $length);
        $pages = $lastPage ? range(1, $lastPage) : [];

        $pageLinks = array_map(
            fn($pageNum) => http_build_query([
                'p' => $pageNum,
                's' => $searchTerm
            ]),
            $pages
        );
        // dd($results);
        echo $this->view->render("index.php", [
            'results' => $results,
            'currentPage' => $page,
            'previousPageQuery' => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm
            ]),
            'lastPage' => $lastPage,
            'nextPageQuery' => http_build_query([
                'p' => $page + 1,
                's' => $searchTerm
            ]),
            'pageLinks' => $pageLinks,
            'searchTerm' => $searchTerm
        ]);
    }
}
