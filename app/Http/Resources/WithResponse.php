<?php declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

trait WithResponse
{
    /**
     * Customize the outgoing response for the resource.
     * 
     * (@override)
     * @return void
     */
    public function withResponse($request, $response)
    {
        $entity = app()->make($this->entity);

        if (($this->resource instanceof $entity) || ($this->resource instanceof Collection)) {
            $response->setStatusCode(
                $request->routeIs("api.{$this->resourceName}.store")
                    ? JsonResponse::HTTP_CREATED
                    : JsonResponse::HTTP_OK
            );
        } else {
            if ($request->routeIs("api.{$this->resourceName}.delete")) {
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
