@extends('layout.main')

@section('title')
    Student Data
@endsection

@section('content')
<div class="container mt-3">
    @if ($message = Session::get('success'))
    <div class="alert alert-success mx-1" role="alert">
        {{ $message }}
    </div>
     @endif
    <h2 class=" text-center">Student Data</h2>
    <div class="mt-5 flex ">
         <a href="{{ route('student.export') }}" class="btn btn-primary">Export Data</a>
        <a href="{{ route('student.create') }}" class="btn btn-primary">Add Data</a>
        <form action="{{route('student.import')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <input type="file" name="file" id="" type="file" accept=".csv, .xls, .xlsx">
            <button type="submit" class="btn btn-primary">Subir</button>
        </form>
        <form action="{{route('student.put_fect_emit')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <input type="file" name="file" id="" type="file" accept=".csv, .xls, .xlsx">
            <button type="submit" class="btn btn-primary">Subir FE</button>
        </form>
        <form action="{{route('student.put_fect_rec')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <input type="file" name="file" id="" type="file" accept=".csv, .xls, .xlsx">
            <button type="submit" class="btn btn-primary">Subir FR</button>
        </form>
    </div>
    
    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Calc</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                  <tr>
                      <td>{{ $student->id }}</td>
                      <td>{{ $student->name }}</td>
                      <td>{{ $student->email }}</td>
                      <td>{{ $student->city }}</td>
                      <td>{{ $student->calc }}</td>
                  </tr>
            @endforeach
        </tbody>
        

    </table>

    <div class="mt-5">
        {{ $students->links() }}
    </div>

    

</div>
@endsection