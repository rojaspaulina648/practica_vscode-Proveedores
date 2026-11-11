<?php
include("conexion.php");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) {
    die("ID de proveedor no válido.");
}

$stmt = $conexion->prepare("SELECT * FROM proveedores WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$proveedor = $resultado->fetch_assoc();

if (!$proveedor) {
    die("No se encontró el proveedor solicitado.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .boton-resaltado {
            transform: translateY(-2px) scale(1.04);
            filter: brightness(1.12);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.20);
        }
        .btn {
            transition: transform 0.18s ease, filter 0.18s ease, box-shadow 0.18s ease;
        }
    </style>

</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning"><h3>Editar Proveedor</h3></div>
        <div class="card-body">
            <form action="actualizar.php" method="POST">
                <input type="hidden" name="id" value="<?= (int)$proveedor['id'] ?>">
                <div class="mb-3">
                    <label class="form-label">Nombre del Cliente</label>
                    <input type="text" name="nombre_c" class="form-control" value="<?= htmlspecialchars($proveedor['nombre_c'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Apellido del Cliente</label>
                    <input type="text" name="apellido_c" class="form-control" value="<?= htmlspecialchars($proveedor['apellido_c'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Teléfono del Cliente</label>
                    <input type="text" name="telefono_c" class="form-control" value="<?= htmlspecialchars($proveedor['telefono_c'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre del Proveedor</label>
                    <input type="text" name="nombre_p" class="form-control" value="<?= htmlspecialchars($proveedor['nombre_p'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Producto</label>
                    <input type="text" name="producto" class="form-control" value="<?= htmlspecialchars($proveedor['producto'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" min="0" value="<?= htmlspecialchars($proveedor['cantidad'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Teléfono del Proveedor</label>
                    <input type="text" name="telefono_p" class="form-control" value="<?= htmlspecialchars($proveedor['telefono_p'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </form>
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
