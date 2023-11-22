<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <!-- Cabecera -->
                    <div class="card-header bg-dark text-light">
                        <h2 class="text-center">La Casona de Jerusalén</h2>
                    </div>
                    <div class="card-body">
                        <!-- Cuerpo del correo -->
                        {!! $body !!}
                    </div>
                    <!-- Pie de página -->
                    <div class="card-footer bg-dark text-light text-center">
                        &copy; {{ date('Y') }} Hostal La Casona de Jerusalén
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
