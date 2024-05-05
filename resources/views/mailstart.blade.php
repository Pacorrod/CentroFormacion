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
        <h1>¡Bienvenido al curso!</h1>
       
        <p>Te damos la más cordial bienvenida al curso "{{ $course->name }}" . El curso comenzará el día <?php echo date('d/m/Y', strtotime($course->startdate)); ?> de {{ $course->schedule }} y estamos emocionados de tenerte como parte de nuestra comunidad de aprendizaje.</p>
        
        <div id="imagen1">
            <img src="{{ asset("storage/{$course->picture}") }}" alt="" >
        </div>
        
        
        <p>Para más detalles sobre el curso contacta con nosotros</p>
        <p>¡Esperamos que tengas una experiencia de aprendizaje increíble!</p>
        
    </div>
</body>
</html>