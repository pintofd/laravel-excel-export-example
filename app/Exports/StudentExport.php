<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct()
    {
        
    }

    public function view(): View
    {
        return view('exports.student', [
            'students' => Student::all()
        ]);
    }
}
