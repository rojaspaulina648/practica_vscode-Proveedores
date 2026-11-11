<?php
include("conexion.php");

$nombre_cliente = trim($_POST["nombre_c"] ?? "");
$apellido_cliente = trim($_POST["apellido_c"] ?? "");
$nombre_proveedor = trim($_POST["nombre_p"] ?? "");
$producto = trim($_POST["producto"] ?? "");
$cantidad = trim($_POST["cantidad"] ?? "");
$telefono_cliente = trim($_POST["telefono_c"] ?? "");
$telefono_proveedor = trim($_POST["telefono_p"] ?? "");

$sql = "INSERT INTO proveedores (nombre_c, apellido_c, nombre_p, producto, cantidad, telefono_c, telefono_p)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssssss", $nombre_cliente, $apellido_cliente, $nombre_proveedor, $producto, $cantidad, $telefono_cliente, $telefono_proveedor);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Error al guardar: " . $stmt->error;
}
?>
