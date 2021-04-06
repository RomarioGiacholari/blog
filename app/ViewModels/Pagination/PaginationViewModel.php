<?php

namespace App\ViewModels\Pagination;

class PaginationViewModel
{
    public int $currentPage;
    public int $totalPages;

    public function __construct(int $currentPage, int $totalPages)
    {
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
    }
}