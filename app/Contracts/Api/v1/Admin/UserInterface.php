<?php

namespace App\Contracts\Api\v1\Admin;

use Illuminate\Database\Eloquent\Model;

interface UserInterface
{
    public function create(array $userData, array $employeeData, array $phoneData, array $documentData): Model;
}
