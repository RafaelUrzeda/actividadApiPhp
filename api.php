<?php
header("Content-Type: application/json; charset=UTF-8");

include_once 'database.php';

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// Routing básico para identificar las tablas
switch ($path[1]) {
    case 'libros':
        handleLibros($db, $method);
        break;
    case 'personajes':
        handlePersonajes($db, $method);
        break;
    case 'objetos':
        handleObjetos($db, $method);
        break;
    case 'lugares':
        handleLugares($db, $method);
        break;
    case 'prestamos':
        handlePrestamos($db, $method);
        break;
    case 'reservas':
        handleReservas($db, $method);
        break;
    default:
        echo json_encode(['mensaje' => 'Endpoint no válido']);
        break;
}

function handleLibros($db, $method) {
    switch ($method) {
        case 'GET':
            $sql = "SELECT * FROM libros";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($libros);
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "INSERT INTO libros (titulo, tema, ejemplares) VALUES (:titulo, :tema, :ejemplares)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':tema', $data['tema']);
            $stmt->bindParam(':ejemplares', $data['ejemplares']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Libro creado']);
            } else {
                echo json_encode(['mensaje' => 'Error al crear libro']);
            }
            break;

        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "UPDATE libros SET titulo = :titulo, tema = :tema, ejemplares = :ejemplares WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':tema', $data['tema']);
            $stmt->bindParam(':ejemplares', $data['ejemplares']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Libro actualizado']);
            } else {
                echo json_encode(['mensaje' => 'Error al actualizar libro']);
            }
            break;

        case 'DELETE':
            $id = $_GET['id'];
            $sql = "DELETE FROM libros WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Libro eliminado']);
            } else {
                echo json_encode(['mensaje' => 'Error al eliminar libro']);
            }
            break;

        default:
            echo json_encode(['mensaje' => 'Método no soportado']);
            break;
    }
}

function handlePersonajes($db, $method) {
    switch ($method) {
        case 'GET':
            $sql = "SELECT * FROM personajes";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $personajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($personajes);
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "INSERT INTO personajes (nombre, rol, descripcion) VALUES (:nombre, :rol, :descripcion)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':rol', $data['rol']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Personaje creado']);
            } else {
                echo json_encode(['mensaje' => 'Error al crear personaje']);
            }
            break;

        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "UPDATE personajes SET nombre = :nombre, rol = :rol, descripcion = :descripcion WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':rol', $data['rol']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Personaje actualizado']);
            } else {
                echo json_encode(['mensaje' => 'Error al actualizar personaje']);
            }
            break;

        case 'DELETE':
            $id = $_GET['id'];
            $sql = "DELETE FROM personajes WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Personaje eliminado']);
            } else {
                echo json_encode(['mensaje' => 'Error al eliminar personaje']);
            }
            break;

        default:
            echo json_encode(['mensaje' => 'Método no soportado']);
            break;
    }
}

function handleLugares($db, $method) {
    switch ($method) {
        case 'GET':
            $sql = "SELECT * FROM lugares";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $lugares = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($lugares);
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "INSERT INTO lugares (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Lugar creado']);
            } else {
                echo json_encode(['mensaje' => 'Error al crear lugar']);
            }
            break;

        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "UPDATE lugares SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Lugar actualizado']);
            } else {
                echo json_encode(['mensaje' => 'Error al actualizar lugar']);
            }
            break;

        case 'DELETE':
            $id = $_GET['id'];
            $sql = "DELETE FROM lugares WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Lugar eliminado']);
            } else {
                echo json_encode(['mensaje' => 'Error al eliminar lugar']);
            }
            break;

        default:
            echo json_encode(['mensaje' => 'Método no soportado']);
            break;
    }
}

function handleObjetos($db, $method) {
    switch ($method) {
        case 'GET':
            $sql = "SELECT * FROM objetos";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $objetos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($objetos);
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "INSERT INTO objetos (nombre, descripcion, poder) VALUES (:nombre, :descripcion, :poder)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':poder', $data['poder']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Objeto creado']);
            } else {
                echo json_encode(['mensaje' => 'Error al crear objeto']);
            }
            break;

        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "UPDATE objetos SET nombre = :nombre, descripcion = :descripcion, poder = :poder WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':poder', $data['poder']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Objeto actualizado']);
            } else {
                echo json_encode(['mensaje' => 'Error al actualizar objeto']);
            }
            break;

        case 'DELETE':
            $id = $_GET['id'];
            $sql = "DELETE FROM objetos WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Objeto eliminado']);
            } else {
                echo json_encode(['mensaje' => 'Error al eliminar objeto']);
            }
            break;

        default:
            echo json_encode(['mensaje' => 'Método no soportado']);
            break;
    }
}

function handleReservas($db, $method) {
    switch ($method) {
        case 'GET':
            $sql = "SELECT * FROM reservas";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($reservas);
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "INSERT INTO reservas (libro_id, usuario_id, fecha_reserva) VALUES (:libro_id, :usuario_id, :fecha_reserva)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':libro_id', $data['libro_id']);
            $stmt->bindParam(':usuario_id', $data['usuario_id']);
            $stmt->bindParam(':fecha_reserva', $data['fecha_reserva']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Reserva creada']);
            } else {
                echo json_encode(['mensaje' => 'Error al crear reserva']);
            }
            break;

        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "UPDATE reservas SET libro_id = :libro_id, usuario_id = :usuario_id, fecha_reserva = :fecha_reserva WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':libro_id', $data['libro_id']);
            $stmt->bindParam(':usuario_id', $data['usuario_id']);
            $stmt->bindParam(':fecha_reserva', $data['fecha_reserva']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Reserva actualizada']);
            } else {
                echo json_encode(['mensaje' => 'Error al actualizar reserva']);
            }
            break;

        case 'DELETE':
            $id = $_GET['id'];
            $sql = "DELETE FROM reservas WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Reserva eliminada']);
            } else {
                echo json_encode(['mensaje' => 'Error al eliminar reserva']);
            }
            break;

        default:
            echo json_encode(['mensaje' => 'Método no soportado']);
            break;
    }
}

function handlePrestamos($db, $method) {
    switch ($method) {
        case 'GET':
            $sql = "SELECT * FROM prestamos";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($prestamos);
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "INSERT INTO prestamos (libro_id, usuario_id, fecha_prestamo, fecha_devolucion) VALUES (:libro_id, :usuario_id, :fecha_prestamo, :fecha_devolucion)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':libro_id', $data['libro_id']);
            $stmt->bindParam(':usuario_id', $data['usuario_id']);
            $stmt->bindParam(':fecha_prestamo', $data['fecha_prestamo']);
            $stmt->bindParam(':fecha_devolucion', $data['fecha_devolucion']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Préstamo creado']);
            } else {
                echo json_encode(['mensaje' => 'Error al crear préstamo']);
            }
            break;

        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "UPDATE prestamos SET libro_id = :libro_id, usuario_id = :usuario_id, fecha_prestamo = :fecha_prestamo, fecha_devolucion = :fecha_devolucion WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':libro_id', $data['libro_id']);
            $stmt->bindParam(':usuario_id', $data['usuario_id']);
            $stmt->bindParam(':fecha_prestamo', $data['fecha_prestamo']);
            $stmt->bindParam(':fecha_devolucion', $data['fecha_devolucion']);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Préstamo actualizado']);
            } else {
                echo json_encode(['mensaje' => 'Error al actualizar préstamo']);
            }
            break;

        case 'DELETE':
            $id = $_GET['id'];
            $sql = "DELETE FROM prestamos WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                echo json_encode(['mensaje' => 'Préstamo eliminado']);
            } else {
                echo json_encode(['mensaje' => 'Error al eliminar préstamo']);
            }
            break;

        default:
            echo json_encode(['mensaje' => 'Método no soportado']);
            break;
    }
}
?>
