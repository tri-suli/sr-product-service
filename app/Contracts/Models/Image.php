<?php declare(strict_types=1);

namespace App\Contracts\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Image extends Enabling
{
    /**
     * Describe the column named 'name' for table 'images'
     * 
     * @var string
     */
    public CONST FIELD_NAME = 'name';

    /**
     * Describe the column named 'file' for table 'images'
     * 
     * @var string
     */
    public CONST FIELD_FILE = 'file';

    /**
     * Describe the pivot key for this model instance.
     * 
     * @var string
     */
    public CONST PIVOT_KEY = 'image_id';

    /**
     * Get all products that related with images record
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany;
}
