<?php

include("conexion.php");

$sql = "SELECT * FROM proveedores ORDER BY id DESC";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CRUD de Proveedores</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

</head>

<head>

    <style>
        .btn {
            transition: transform 0.2s ease,
                        box-shadow 0.2s ease,
                        filter 0.2s ease;
        }

        .btn.boton-resaltado {
            transform: translateY(-3px) scale(1.05);
            filter: brightness(1.12);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.25);
        }
    </style>

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h2 class="text-center">
                Sistema de Proveedores
            </h2>

        </div>

        <div class="card-body">

            <h4 class="mb-4">
                Registrar proveedor
            </h4>

            <form action="guardar.php" method="POST">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nombre del Cliente
                        </label>

                        <input 
                            type="text"
                            name="nombre_c"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Apellido del Cliente
                        </label>

                        <input 
                            type="text"
                            name="apellido_c"
                            class="form-control"
                            required
                        >                    
                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nombre del Proveedor
                        </label>

                        <input 
                            type="text"
                            name="nombre_p"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Producto
                        </label>

                        <input 
                            type="text"
                            name="producto"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Cantidad
                        </label>

                        <input 
                            type="number"
                            name="cantidad"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Telefono del Cliente
                        </label>

                        <input 
                            type="text"
                            name="telefono_c"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Telefono del Proveedor
                        </label>

                        <input 
                            type="text"
                            name="telefono_p"
                            class="form-control"
                            required
                        >

                    </div>

                </div>

                <button 
                    type="submit"
                    class="btn btn-success"
                >
                    Registrar Proveedor
                </button>            
            </form>

        </div>

    </div>


    <div class="card shadow mt-4">

        <div class="card-header">

            <h4>
                Lista de Proveedores
            </h4>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Nombre del Cliente</th>
                            <th>Telefono del Cliente</th>
                            <th>Nombre del Proveedor</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Telefono del Proveedor</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php while($proveedor = $resultado->fetch_assoc()) { ?>

                        <tr>

                            <td>
                                <?php echo htmlspecialchars((string)($proveedor['id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars(($proveedor['nombre_c'] ?? '') . ' ' . ($proveedor['apellido_c'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars((string)($proveedor['telefono_c'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars((string)($proveedor['nombre_p'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars((string)($proveedor['producto'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                            </td>
                            
                            <td>
                                <?php echo htmlspecialchars((string)($proveedor['cantidad'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars((string)($proveedor['telefono_p'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                            </td>

                            <td>

                                <a 
                                    href="editar.php?id=<?php echo htmlspecialchars((string)($proveedor['id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
                                    class="btn btn-warning btn-sm"
                                >
                                    Editar
                                </a>

                                <a 
                                    href="eliminar.php?id=<?php echo htmlspecialchars((string)($proveedor['id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Deseas eliminar este proveedor?')"
                                >
                                    Eliminar
                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<script>
    const botones = document.querySelectorAll(".btn");

    function cambiarDisenoBoton(evento) {
        evento.currentTarget.classList.add("boton-resaltado");
    }

    function restaurarDisenoBoton(evento) {
        evento.currentTarget.classList.remove("boton-resaltado");
    }

    botones.forEach(function(boton) {
        boton.addEventListener("mouseenter", cambiarDisenoBoton);
        boton.addEventListener("mouseleave", restaurarDisenoBoton);
    });
</script>

</body>

</html>