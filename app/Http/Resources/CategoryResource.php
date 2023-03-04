<?php

namespace App\Http\Resources;

use App\Contracts\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    use WithMeta;

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

    /**
     * Customize the outgoing response for the resource.
     * 
     * (@override)
     * @return void
     */
    public function withResponse($request, $response)
    {
        if ($request->routeIs('api.category.store')) {
            if (($this->resource instanceof Category)) {
                $response->setStatusCode(JsonResponse::HTTP_CREATED);
            } else {
                $response->setStatusCode(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
    }
}
