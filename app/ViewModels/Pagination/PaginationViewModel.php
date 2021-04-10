<?php

namespace App\ViewModels\Pagination;

class PaginationViewModel
{
    public int $page;
    public int $totalPages;

    public function __construct(int $page, int $totalPages)
    {
        $this->page = $page;
        $this->totalPages = $totalPages;
    }
}