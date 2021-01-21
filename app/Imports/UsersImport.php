<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $data)
    {
        $id = mt_rand(1000, 9999);
        return new User([
            'email' => 'ST' . $id,
            'surname' => $data['surname'],
            'last_name' => $data['last_name'],
            'class_id' => Session::get('bulk_class'),
            'role' => 'Student',
            'password' => Hash::make(strtolower($data['surname'])),
        ]);
    }
}
