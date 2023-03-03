<?php declare(strict_types=1);

namespace App\Contracts\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Category extends Enabling
{
    /**
     * Describe the default category names
     * 
     * @var array<string>
     */
    public CONST DEFAULT = [
        'convenience_goods',
        'shopping_goods',
        'specialty_goods',
        'unsought_goods',
    ];

    /**
     * Describe the column named 'name' for table 'categories'
     * 
     * @var string
     */
    public CONST FIELD_NAME = 'name';

    /**
     * Describe the pivot key for this model instance.
     * 
     * @var string
     */
    public CONST PIVOT_KEY = 'category_id';

    /**
     * Get all products that related with categories record
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany;
}
