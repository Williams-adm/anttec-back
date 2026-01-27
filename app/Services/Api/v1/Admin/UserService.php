<?php

namespace App\Services\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\UserInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class UserService
{
    public function __construct(
        protected UserInterface $repository,
    ) {}

    public function create(array $data): Model
    {
        $userData = Arr::only($data, [
            'name',
            'last_name',
            'email',
            'password',
            'date_birth',
        ]);
        $employeeData = Arr::only($data, [
            'salary',
            'position',
        ]);
        $phoneData = Arr::only($data, [
            'phone',
        ]);
        $documentData = Arr::only($data, [
            'document_number',
            'document_type_id',
        ]);

        return $this->repository->create($userData, $employeeData, $phoneData, $documentData);
    }
}
