<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Estilos CSS para el cuerpo del correo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #007bff;
            text-align: center;
        }

        p {
            margin-bottom: 20px;
        }
        

        #imagen1 {
            margin: auto;
            text-align: center; /* Para centar la imagen dentro del contenedor */
        }

        #imagen1 img {
            width: 50%;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Nuevo curso!</h1>
       
        <p>Hola {{ $student->name }}. ¡Regresa y lleva tus habilidades al siguiente nivel!. El día <?php echo date('d/m/Y', strtotime($course->startdate)); ?> de {{ $course->schedule }} dará comienzo el nuevo curso de <strong>{{ $course->name }}</strong> .
            Amplía tus conocimientos y continúa tu viaje de aprendizaje con nosotros hoy mismo.</p>
        
        <div id="imagen1">
            <img src="{{ asset("storage/{$course->picture}") }}" alt="" >
        </div>
        
        
        <center><p>Para más detalles sobre el curso contacta con nosotros</p>
            <p>¡Esperamos verte pronto!</p> <strong><p>Centro de Formación</p></strong></center>
       
    </div>
</body>
</html>