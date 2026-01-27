<?php

namespace App\Http\Resources\Api\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'last_name' => $this->last_name,
            'email'     => $this->email,

            'employee' => $this->whenLoaded('employee', function () {
                return [
                    'salary'   => $this->employee->salary,
                    'position' => $this->employee->position,

                    'phone' => $this->employee->relationLoaded('phone') && $this->employee->phone
                        ? [
                            'number' => $this->employee->phone->number,
                            'prefix' => $this->employee->phone->prefix->prefix,
                        ]
                        : null,

                    'document' => $this->employee->relationLoaded('documentNumber') && $this->employee->documentNumber
                        ? [
                            'number' => $this->employee->documentNumber->number,
                            'type'   => $this->employee->documentNumber->documentType->type,
                        ]
                        : null,
                ];
            }),
        ];
    }
}
