<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use SebastianBergmann\Exporter\Exporter;

class PostApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $fields = explode(",", $request->fields);

        // foreach ($fields as &$field) {
        //     $field = explode(".", $field);
        // }
        // echo '<pre>';
        // print_r($fields);
        // echo '</pre>';
        // return [];
        $isEmptyFields = !!$fields[0];


        $allowedFields = [
            "id" => $this->id,
            "title" => $this->title,
            "disc" => $this->disc,
            "image" => $this->image,
            "created_at" => $this->created_at,
            "user" => [
                "id" => $this->user->id,
                "name" => $this->user->name,
                "profile_img" => $this->user->profile_img,
                "email" => $this->user->email
            ]
        ];

        // var_dump(array_flip(explode(",", $fields)));
        $filterByQueryFields = $isEmptyFields ? array_intersect_key($allowedFields, array_flip($fields)) : $allowedFields;
        return $filterByQueryFields;
    }
}
