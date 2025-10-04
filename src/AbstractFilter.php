<?php

namespace Curvestech\LaravelRequestFilters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class AbstractFilter
{
    public function __construct(
        protected Request $request
    )
    {
    }

    public function apply(Builder $builder): Builder
    {
        foreach ($this->request->all() as $filter => $value) {
            if (
                method_exists($this, $filter) &&
                !empty($value)
            ) {
                $builder = $this->$filter($builder, $value);
            }
        }
        return $builder;
    }
}