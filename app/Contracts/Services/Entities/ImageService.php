<?php declare(strict_types=1);

namespace App\Contracts\Services\Entities;

use App\Contracts\Models\Image;
use Illuminate\Database\Eloquent\Collection;

interface ImageService extends EntityService
{
    /**
     * Store the specified images into datatabse and storage
     *
     * @param   string $pathToFile
     * @param   array<int, UploadedFile> $files
     * @return  Collection
     */
    public function storeMany(string $pathToFile, array $files): Collection;
}
