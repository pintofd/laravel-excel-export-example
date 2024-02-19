<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use App\Imports\FactEmiImport;
use App\Imports\FactEmiImport2;
use App\Imports\FactRecImport;
use App\Imports\FactRecImport2;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreStudentRequest;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(5);
        
        return view('student.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->city = $request->city;
        $student->save();
        return redirect(route('student.index'))->with('success','Data submited successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_student_data()
    {
        return Excel::download(new StudentExport, 'students.xlsx');
    }

    /**
* Uploads the records in a csv file or excel using maatwebsite package 
*
* @param Request $request
* @return mixed
*/
    public function put_student_data(Request $request)
    {
        if ($request->file) {
            $file = $request->file;
            $extension = $request->file('file')->getClientOriginalExtension(); //Get extension of uploaded file
            $fileSize = $request->file('file')->getSize(); //Get size of uploaded file in bytes
            //Checks to see that the valid file types and sizes were uploaded
            $this->checkUploadedFileProperties($extension, $fileSize);
            $import = new StudentImport();
            Excel::import($import, $request->file);
            /* foreach ($import->data as $user) {
                //sends email to all users
                $this->sendEmail($user->email, $user->name);
            } */
            //Return a success response with the number if records uploaded
            /* return response()->json([
            'message' => $import->data->count() ." records successfully uploaded"
            ]); */
            return back();
        } else {
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
* Checks to see that the uploaded file valid and within acceptable size limits
*
* @param string $extension
* @param integer $fileSize
* @return void
*/
    public function checkUploadedFileProperties($extension, $fileSize) : void
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
            throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
        throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }


    public function put_fect_emit(Request $request)
    {
        if ($request->file) {
            $file = $request->file;
            $extension = $request->file('file')->getClientOriginalExtension(); //Get extension of uploaded file
            $fileSize = $request->file('file')->getSize(); //Get size of uploaded file in bytes
            //Checks to see that the valid file types and sizes were uploaded
            $this->checkUploadedFileProperties($extension, $fileSize);
            $import = new FactEmiImport2();
            Excel::import($import, $request->file);
            /* foreach ($import->data as $user) {
                //sends email to all users
                $this->sendEmail($user->email, $user->name);
            } */
            //Return a success response with the number if records uploaded
            /* return response()->json([
            'message' => $import->data->count() ." records successfully uploaded"
            ]); */
            return back();
        } else {
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function put_fect_rec(Request $request)
    {
        if ($request->file) {
            $file = $request->file;
            $extension = $request->file('file')->getClientOriginalExtension(); //Get extension of uploaded file
            $fileSize = $request->file('file')->getSize(); //Get size of uploaded file in bytes
            //Checks to see that the valid file types and sizes were uploaded
            $this->checkUploadedFileProperties($extension, $fileSize);
            $import = new FactRecImport2();
            Excel::import($import, $request->file);
            /* foreach ($import->data as $user) {
                //sends email to all users
                $this->sendEmail($user->email, $user->name);
            } */
            //Return a success response with the number if records uploaded
            /* return response()->json([
            'message' => $import->data->count() ." records successfully uploaded"
            ]); */
            return back();
        } else {
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }
}
