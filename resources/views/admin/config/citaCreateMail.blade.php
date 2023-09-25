<!DOCTYPE html>
<html>
<head>
    <title>Recordatorio de Cita Médica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            line-height: 1.6;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        li strong {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Recordatorio de Cita Médica</h2>
        
        <p>Estimado(a) {{ $nombrePaciente }},</p>
        
        <p>Le recordamos su próxima cita médica programada para:</p>
        
        <ul>
            <li><strong>Fecha:</strong> {{ date('d-m-Y', strtotime($FechaCita)) }}</li>
            <li><strong>Hora:</strong> {{ $HoraCita }}</li>
        </ul>
        
        <p>Por favor, asegúrese de llegar a tiempo y traer la documentación necesaria.</p>
        
        <p>Si necesita reprogramar la cita o tiene alguna pregunta, no dude en ponerse en contacto con nosotros.</p>
        
        <p>¡Esperamos verlo pronto!</p>
        
        <p>Atentamente,<br>{{$business->name}}</p>
        <span>{{$business->address}}</span><br>
        <span>{{$business->phone}}</span><br>
        <span>{{$business->mail}}</span>
    </div>
</body>
</html>
