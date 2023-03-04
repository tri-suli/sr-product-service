<?php declare(strict_types=1);

namespace App\Services\Entities;

use App\Contracts\Models\Image;
use App\Contracts\Services\Entities\ImageService as ServiceContract;

/**
 * Service to handle image resources
 * 
 * @final
 * @author Tri Suli Prasetyo <trisulipras@gmail.com>
 */
final class ImageService extends EntityService implements ServiceContract
{
    /**
     * Get the model contract name of image service 
     *
     * @return string
     */
    public function entityContract(): string
    {
        return Image::class;
    }
}
