<?php declare(strict_types=1);

namespace App\Models\Traits;

use App\Contracts\Models\Enabling;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait WithEnable
{
    /**
     * Query scope to only take records that are currently disabled
     *
     * @param   Builder $query
     * @param   bool    $status
     * @return  Builder
     */
    public function scopeEnable(Builder $query, bool $status): Builder
    {
        return $query->where('enable', $status);
    }

    /**
     * Query scope to only take records that are currently disabled
     *
     * @param   Builder  $query
     * @return  Builder
     */
    public function scopeDisabled(Builder $query): Builder
    {
        return $this->scopeEnable($query, Enabling::IS_DISBALED);
    }

    /**
     * Query scope to only take records that are currently enabled
     *
     * @param    Builder  $query
     * @return   Builder
     */
    public function scopeEnabled(Builder $query): Builder
    {
        return $this->scopeEnable($query, Enabling::IS_ENABLED);
    }
}
