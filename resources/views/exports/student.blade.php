<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>City</th>
        <th>Calc</th>

    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email}}</td>
            <td>{{ $student->city}}</td>
            <td>{{ $student->calc}}</td>
        </tr>
    @endforeach
    </tbody>
</table>