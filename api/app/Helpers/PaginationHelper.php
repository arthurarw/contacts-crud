<?php

namespace App\Helpers;

class PaginationHelper
{
    public static function getPerPage(int $quantity = null): int
    {
        $perPage = request()->input('per_page') ? (int)request()->input('per_page') : (int)request()->input('perPage');
        if (empty($perPage) || $perPage > 100) {
            return $quantity ?? 10;
        }

        return $perPage;
    }

    public static function getPage(): int
    {
        $page = request()->input('page');
        if (empty($page)) {
            return 1;
        }

        return (int)$page;
    }
}
