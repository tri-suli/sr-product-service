<?php declare(strict_types=1);

namespace App\Contracts\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Product extends Enabling
{
    /**
     * Describe the column named 'name' for table 'products'
     * 
     * @var string
     */
    public CONST FIELD_NAME = 'name';

    /**
     * Describe the column named 'description' for table 'products'
     * 
     * @var string
     */
    public CONST FIELD_DESCRIPTION = 'description';

    /**
     * Describe the pivot key for this model instance.
     * 
     * @var string
     */
    public CONST PIVOT_KEY = 'product_id';

    /**
     * Get all categories that related with products record
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany;

    /**
     * Get all images that related with products record
     *
     * @return BelongsToMany
     */
    public function images(): BelongsToMany;
}
