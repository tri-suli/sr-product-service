<?php declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait WithEnable
{
    /**
     * Query scope to only take records that are currently disabled
     *
     * @param   Builder  $query
     * @return  Builder
     */
    public function scopeDisabled(Builder $query): Builder
    {
        return $query->where('enable', false);
    }

    /**
     * Query scope to only take records that are currently enabled
     *
     * @param    Builder  $query
     * @return   Builder
     */
    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('enable', true);
    }
}
