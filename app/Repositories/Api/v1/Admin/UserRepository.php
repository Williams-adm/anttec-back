<?php

namespace App\Repositories\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    public function create(array $userData, array $employeeData, array $phoneData, array $documentData): Model
    {
        return DB::transaction(function () use (
            $userData,
            $employeeData,
            $phoneData,
            $documentData
        ) {
            $user = User::create([
                'name' => $userData['name'],
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'date_birth' => $userData['date_birth'] ?? null,
            ]);

            $employee = $user->employee()->create([
                'salary'=> $employeeData['salary'],
                'position' => $employeeData['position'],
                'branch_id' => 1
            ]);

            $employee->phone()->create([
                'number' => $phoneData['phone'],
                'prefix_id' => 1,
            ]);
            $employee->documentNumber()->create([
                'number' => $documentData['document_number'],
                'document_type_id' => $documentData['document_type_id'],
            ]);

            return $user->load('employee.phone', 'employee.documentNumber');
        });
    }
}
