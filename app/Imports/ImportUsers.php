<?php

namespace App\Imports;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class ImportUsers implements OnEachRow,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function onRow(Row $row)
    {
        $row = $row->toCollection();
        User::updateOrCreate(
            [
                'student_id' => $row['student_id'],
            ],
            [
                'name' => $row['name'],
                'phone' => '0'.$row['phone'],
                'level' => 2,
                'address' => $row['address'],
                'email' => $row['email'],
                'password' => $row['password'],
            ]);
    }
}
