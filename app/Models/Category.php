<?php

namespace App\Models;

use App\Contracts\Models\Category as ModelsContract;
use App\Models\Traits\WithEnable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model implements ModelsContract
{
    use HasFactory;
    use WithEnable;

    /**
     * The attributes that are mass assignable.
     *
     * (@override)
     * @var array<string>
     */
    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_ENABLE,
    ];

    /**
     * Get all products that related with this categories
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
