<?php declare(strict_types=1);

namespace App\Contracts\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface Enabling
{
    /**
     * Describe db table field named 'enable'
     * 
     * @var  string
     */
    public CONST FIELD_ENABLE = 'enable';

    /**
     * Query scope to only take records that are currently disabled
     *
     * @param   Builder  $query
     * @return  Builder
     */
    public function scopeDisabled(Builder $query): Builder;

    /**
     * Query scope to only take records that are currently enabled
     *
     * @param    Builder  $query
     * @return   Builder
     */
    public function scopeEnabled(Builder $query): Builder;
}
