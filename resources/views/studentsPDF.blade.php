<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        @page {
            size: A4 landscape;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
       
        padding: 8px;
        text-align: left;
        border: none;
    }
    th {
        background-color: #f2f2f2;
    }
    p{
        text-align: right;
    }
    </style>
</head>
<body>
    <h2>Alumnos del curso: <?php echo $students->first()->courses->name; ?></h2>
    <p>Fecha: {{$date}}</p>
    <table class="table table-bordered">
        <thead>
            <th>Nombre</th>
            <th>Poblacion</th>
            <th>Telefono</th>
            <th>Email</th>
        </thead>
        <tbody>
            @foreach ($students->sortBy('Students.name') as $student)
                <tr>
                    <td>{{$student->Students->name}}</td>
                    <td>{{$student->students->city}}</td>
                    <td>{{$student->students->phone}}</td>
                    <td>{{$student->students->email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>