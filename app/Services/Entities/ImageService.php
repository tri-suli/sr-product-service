<?php declare(strict_types=1);

namespace App\Services\Entities;

use App\Contracts\Models\Image;
use App\Contracts\Services\Entities\ImageService as ServiceContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Store the specified images into datatabse and storage
     *
     * @param   string $pathToFile
     * @param   array<int, UploadedFile>
     * @return  Collection
     */
    public function storeMany(string $pathToFile, array $files): Collection
    {
        $images = Collection::make();

        foreach ($files as $file) {
            $record = [
                'name' => $file->getClientOriginalName(),
                'file' => $file->store("images/$pathToFile"),
                'enable' => true,
            ];
            $entity = parent::store($record);
            $images->push($entity);
        }

        return $images;
    }
}
