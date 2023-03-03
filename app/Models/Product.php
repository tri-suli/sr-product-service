<?php

namespace App\Models;

use App\Contracts\Models\Product as ModelsContract;
use App\Models\Traits\WithEnable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model implements ModelsContract
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
        self::FIELD_DESCRITION,
        self::FIELD_ENABLE,
    ];

    /**
     * Get all categories that related with products record
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_id', 'id');
    }

    /**
     * Get all images that related with products record
     *
     * @return BelongsToMany
     */
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'image_id', 'id');
    }
}