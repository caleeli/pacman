<?php

namespace JDD\Pacman\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(
 *      schema="PacmanPackageEditable",
 *      @OA\Property(
 *          property="attributes",
 *          type="object",
 *          @OA\Property(property="url", type="string"),
 *          @OA\Property(property="name", type="string"),
 *          @OA\Property(property="description", type="string"),
 *          @OA\Property(property="branch", type="string"),
 *          @OA\Property(property="authors", type="string"),
 *          @OA\Property(property="icon", type="string"),
 *      )
 *  )
 *
 *  @OA\Schema(
 *      schema="PacmanPackage",
 *      allOf={
 *          @OA\Schema(
 *              @OA\Property(property="id", type="string", format="id"),
 *          ),
 *          @OA\Schema(ref="#/components/schemas/PacmanPackageEditable"),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="attributes",
 *                  type="object",
 *              )
 *          )
 *      }
 *  )
 */
class Package extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getUrl(),
            'attributes' => [
                'url' => $this->getUrl(),
                'name' => $this->getName(),
                'branch' => $this->getBranch(),
                'description' => $this->getDescription(),
                'authors' => $this->getAuthors(),
                'icon' => $this->getIcon(),
                'status' => $this->getStatus(),
            ],
        ];
    }
}
