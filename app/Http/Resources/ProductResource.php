<?php

namespace App\Http\Resources;

use App\Contracts\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    use WithResponse;

    /**
     * Defined the resource entity.
     *
     * @var string
     */
    public string $entity = Product::class;

    /**
     * Defined the resource name.
     *
     * @var string  [Should be the same name with the api prefix name]
     */
    public string $resourceName = 'product';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
