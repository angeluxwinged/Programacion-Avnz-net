<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        body{
            background: #dc3545;
        }
    </style>
</head>

<body>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
                    <div class="col-md-4">
                        <form class="form bg-light p-5" action="" method="post">
                            <h3 class="text-center text-danger mb-4">Login</h3>
                            <div class="form-group mb-4">
                                <label class="text-danger">Nombre de Usuario:</label><br>
                                <input type="text" class="form-control">
                            </div>

                            <div class="form-group mb-4">
                                <label class="text-danger">Contraseña:</label><br>
                                <input type="password" class="form-control">
                            </div>
                            
                            <div class="form-group d-grid gap-2 pt-3">
                                <input type="submit" name="submit" class="btn btn-danger" value="Acceder">
                            </div>
                        </form>
                    </div>
            </div>
        </div>

</body>
</html>