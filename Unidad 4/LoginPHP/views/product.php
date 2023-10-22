<?php 
    session_start();

    if(!$_SESSION['email']){
        header("Location: ../index.php");
    }

    include "../controllers/ProductsController.php";
    $productController = new ProductsController();
    $product = $productController->getProductById();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        body{
            /* background: #dc3545; */
        }
    </style>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 8vh;">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-danger" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>

        <div class="row m-0 p-0">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 200px; min-height: 100vh;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Sidebar</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                    Home
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                    Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                    Orders
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                    Products
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                    Customers
                    </a>
                </li>
                </ul>
                <hr>
                <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong><?= $_SESSION['name'] ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1" style="">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
                </div>
            </div>

            <div class="col">
                <div class="card m-3">
                    <img src="<?php echo $product->cover; ?>" class="card-img-top mx-auto m-2" style="width: 500px;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product->name?> <?php if ($product->brand?->name !== null): ?> - <a class="text-decoration-none link-danger" href=""><?php echo $product->brand->name?> </a> <?php endif; ?></h5>
                        <p class="card-text"><?php echo $product->description; ?></p>
                        <p class="card-text"><?php echo $product->features; ?></p>

                        <p class="fw-bold">Presentaciones:</p>
                        <div class="row">
                            <?php foreach ($product->presentations as $presentations): ?>
                                <div class="col-md-3 text-center mx-auto">
                                    <p class="card-text"><?php echo $presentations->description; ?></p>
                                    <p class="card-text"><?php echo $presentations->stock . " en existencia."; ?></p>
                                    <input type="number" value="1" style="width: 70px;"><br><br>
                                    <a href="#" class="btn btn-success">Comprar</a>
                                </div>
                            <?php endforeach; ?>
                        </div><br><br>

                        <p class="fw-bold">Etiquetas:</p>
                        <div class="row">
                            <?php foreach ($product->tags as $tags): ?>
                                <div class="col">
                                    <a href="#" class="text-decoration-none text-muted "><?php echo $tags->name; ?></a>
                                </div>
                            <?php endforeach; ?>
                        </div><br>

                        <p class="fw-bold">Categorias:</p>
                        <div class="row">
                            <?php foreach ($product->categories as $categories): ?>
                                <div class="col">
                                    <a class="text-decoration-none text-muted" href=""><?php echo $categories->name; ?></a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>