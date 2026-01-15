<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSearchableTable
{
    protected function buildTableQuery(
        string $modelClass,
        array $searchFields = [],
    ) {
        $search = request()->query("filter.search");

        return $modelClass
            ::query()
            ->when($search, function (Builder $query) use (
                $search,
                $searchFields,
            ) {
                $query->where(function ($q) use ($search, $searchFields) {
                    foreach ($searchFields as $field) {
                        $q->orWhere($field, "like", "%{$search}%");
                    }
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }
}
