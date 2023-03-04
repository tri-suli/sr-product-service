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
     * This constant is used to checking if the current model
     * is enabled
     * 
     * @var bool
     */
    public CONST IS_ENABLED = true;

    /**
     * This constant is used to checking if the current model
     * is disabled
     * 
     * @var bool
     */
    public CONST IS_DISBALED = false;

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
