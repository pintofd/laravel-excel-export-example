<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel,  WithHeadingRow
{
    public $data;
    public function __construct()
    {
    $this->data = collect();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   $calc = $row['name']."/".$row['city'];
        $model = Student::firstOrCreate([
            'name' => $row['name'],
        ],[
                'name' => $row['name'],
                'email' => $row['email'],
                'city' => $row['city'],
                'calc' => $calc
        ]);
        $this->data->push($model);
        return $model;
    }
}
