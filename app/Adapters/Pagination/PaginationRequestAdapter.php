<?php

namespace App\Adapters\Pagination;

use Illuminate\Http\Request;

class PaginationRequestAdapter
{
    public static function getPage(Request $request): int
    {
        $page = $request->query('page') ?? 1;

        if ($page < 1) {
            $page = 1;
        }

        return $page;
    }
}
