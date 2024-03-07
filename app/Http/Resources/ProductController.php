<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this){
            return [
                'id' => $this -> id,
                'name' => $this -> name,
                'picture' => $this -> picture,
                'description' => $this -> description,
                'price_base' => $this -> price_base,
                'price_final' => $this -> price_final,
                'information' => $this -> information,
                'category' => $this -> categories -> name,
                'tags' => $this -> tags -> pluck('name') -> toArray(),
                'status' => $this -> status,
                'type' => $this -> type,
                'slug' => $this -> slug,
                'created_at' => $this -> created_at,
                'updated_at' => $this -> updated_at,
            ];
        }

        else{
            return [
                'message' => 'something went wrong'
            ];
        }
    }

    public function with($request)
    {
        return [
            'meta' => [
                'key' => 'value',
            ],
        ];
    }
}
