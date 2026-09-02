<?php

use App\Helpers\QueryHelper;
use Illuminate\Database\Eloquent\Builder;


if (!function_exists('query_search')) {
    function query_search(Builder $query, ?string $search = '', array $targets = [])
    {
        return QueryHelper::searchCallback($query, $search, $targets);
    }
}

if (!function_exists('query_filter')) {
    function query_filter(Builder $query, array $filters = [], array $definitions = [])
    {
        return QueryHelper::filterCallback($query, $filters, $definitions);
    }
}

