<?php

namespace App\ViewModels\Pagination;

class PaginationViewModel
{
    public int $page;
    public int $totalPages;

    public function __construct(int $page, int $totalPages)
    {
        $this->page = static::setPage($page);
        $this->totalPages = static::setTotalPages($totalPages);
    }

    private static function setPage(int $page): int
    {
        if ($page < 1) {
            $page = 1;
        }

        return $page;
    }

    private static function setTotalPages(int $totalPages): int
    {
        if ($totalPages < 1) {
            $totalPages = 1;
        }

        return $totalPages;
    }
}
