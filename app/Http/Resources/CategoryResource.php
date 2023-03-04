<?php

namespace App\Http\Resources;

use App\Contracts\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

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
        if (($this->resource instanceof Category) || ($this->resource instanceof Collection)) {
            $response->setStatusCode(
                $request->routeIs('api.category.store')
                    ? JsonResponse::HTTP_CREATED
                    : JsonResponse::HTTP_OK
            );
        } else {
            if ($request->routeIs('api.category.delete')) {
                $response->setStatusCode(
                    Arr::has($this->resource, 'errors')
                        ? JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                        : JsonResponse::HTTP_OK
                );
            } else {
                $response->setStatusCode(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

        }
    }
}
