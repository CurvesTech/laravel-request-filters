<?php
namespace Curvestech\LaravelRequestFilters\Traits;

use Illuminate\Database\Eloquent\Builder;
use Curvestech\LaravelRequestFilters\AbstractFilter;

trait Filterable
{
    public function scopeFilter(
        Builder $builder,
        AbstractFilter $filters
    ): Builder
    {
        return $filters->apply($builder);
    }
}