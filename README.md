# Documentación de API en PHP para Gestión de Biblioteca de Mitología Griega

Este archivo PHP implementa una API para gestionar recursos relacionados con la temática de la **mitología griega**, como libros sobre dioses griegos, personajes mitológicos, objetos míticos, lugares sagrados, y la administración de préstamos y reservas. La API permite realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) para estos recursos a través de diferentes endpoints.

## Configuración Inicial
1. Se establece el tipo de contenido como JSON con `header("Content-Type: application/json; charset=UTF-8");`.
2. Se incluye el archivo `database.php` para acceder a la conexión de la base de datos.

## Enrutamiento
La API usa el recurso solicitado y el método HTTP (`GET`, `POST`, `PUT`, `DELETE`) para realizar la operación adecuada. Se utilizan los valores de `$_SERVER['REQUEST_METHOD']` y `$_SERVER['REQUEST_URI']`.

### Rutas Disponibles
Los recursos están relacionados con la mitología griega:
- `/libros` - Operaciones CRUD para libros sobre dioses griegos.
- `/personajes` - Operaciones CRUD para personajes mitológicos.
- `/objetos` - Operaciones CRUD para objetos míticos.
- `/lugares` - Operaciones CRUD para lugares de relevancia en la mitología griega.
- `/prestamos` - Administración de préstamos de libros.
- `/reservas` - Administración de reservas de libros.

## Funciones de Manejo de Recursos

### `handleLibros($db, $method)`
Gestiona el recurso **libros sobre mitología griega**:
- **GET**: Obtiene todos los libros relacionados con dioses griegos.
- **POST**: Crea un nuevo libro, con datos como `titulo` (por ejemplo, *"Los Mitos de Zeus"*), `tema` (categoría como "dioses olímpicos"), y `ejemplares`.
- **PUT**: Actualiza un libro existente mediante su `id`.
- **DELETE**: Elimina un libro específico mediante su `id`.

### `handlePersonajes($db, $method)`
Gestiona el recurso **personajes mitológicos**:
- **GET**: Obtiene una lista de personajes mitológicos griegos.
- **POST**: Crea un personaje, con atributos como `nombre` (por ejemplo, *"Atenea"*), `rol` (como "diosa de la sabiduría") y `descripcion`.
- **PUT**: Actualiza un personaje existente mediante su `id`.
- **DELETE**: Elimina un personaje específico mediante su `id`.

### `handleObjetos($db, $method)`
Gestiona el recurso **objetos míticos**:
- **GET**: Obtiene todos los objetos míticos (como *"Rayo de Zeus"* o *"Escudo de Atenea"*).
- **POST**: Crea un objeto con `nombre`, `descripcion` y `poder`.
- **PUT**: Actualiza un objeto mediante su `id`.
- **DELETE**: Elimina un objeto específico mediante su `id`.

### `handleLugares($db, $method)`
Gestiona el recurso **lugares sagrados en la mitología griega**:
- **GET**: Obtiene una lista de lugares míticos (por ejemplo, *"Monte Olimpo"*).
- **POST**: Crea un lugar con `nombre` y `descripcion`.
- **PUT**: Actualiza un lugar existente mediante su `id`.
- **DELETE**: Elimina un lugar específico mediante su `id`.

### `handlePrestamos($db, $method)`
Gestiona el recurso **préstamos de libros** sobre mitología griega:
- **GET**: Obtiene todos los préstamos de libros.
- **POST**: Crea un préstamo de un libro mediante `libro_id`, `usuario_id`, `fecha_prestamo`, `fecha_devolucion`.
- **PUT**: Actualiza un préstamo mediante su `id`.
- **DELETE**: Elimina un préstamo específico mediante su `id`.

### `handleReservas($db, $method)`
Gestiona el recurso **reservas de libros** sobre mitología griega:
- **GET**: Obtiene todas las reservas.
- **POST**: Crea una reserva con `libro_id`, `usuario_id`, `fecha_reserva`.
- **PUT**: Actualiza una reserva mediante su `id`.
- **DELETE**: Elimina una reserva específica mediante su `id`.

## Mensajes de Respuesta
Cada operación envía una respuesta JSON con un mensaje que indica el éxito o error en la operación realizada, como: `{'mensaje': 'Libro creado'}` o `{'mensaje': 'Error al actualizar personaje'}`.

## Ejemplo de Petición
```bash

# **Libros**
# Obtener todos los libros (GET)
curl -X GET http://localhost/api.php/libros

# Crear un nuevo libro (POST)
curl -X POST http://localhost/api.php/libros \
     -H "Content-Type: application/json" \
     -d '{
           "titulo": "La Odisea",
           "tema": "Épica",
           "ejemplares": 3
         }'

# Actualizar un libro existente (PUT)
curl -X PUT http://localhost/api.php/libros \
     -H "Content-Type: application/json" \
     -d '{
           "id": 1,
           "titulo": "La Ilíada",
           "tema": "Mitología",
           "ejemplares": 5
         }'

# Eliminar un libro (DELETE)
curl -X DELETE http://localhost/api.php/libros?id=1


# **Personajes**
# Obtener todos los personajes (GET)
curl -X GET http://localhost/api.php/personajes

# Crear un nuevo personaje (POST)
curl -X POST http://localhost/api.php/personajes \
     -H "Content-Type: application/json" \
     -d '{
           "nombre": "Hércules",
           "rol": "Héroe",
           "descripcion": "Hijo de Zeus, famoso por su fuerza y sus doce trabajos."
         }'

# Actualizar un personaje existente (PUT)
curl -X PUT http://localhost/api.php/personajes \
     -H "Content-Type: application/json" \
     -d '{
           "id": 1,
           "nombre": "Aquiles",
           "rol": "Guerrero",
           "descripcion": "Héroe invulnerable, excepto en su talón."
         }'

# Eliminar un personaje (DELETE)
curl -X DELETE http://localhost/api.php/personajes?id=1


# **Lugares**
# Obtener todos los lugares (GET)
curl -X GET http://localhost/api.php/lugares

# Crear un nuevo lugar (POST)
curl -X POST http://localhost/api.php/lugares \
     -H "Content-Type: application/json" \
     -d '{
           "nombre": "Monte Olimpo",
           "descripcion": "Morada de los dioses en la mitología griega."
         }'

# Actualizar un lugar existente (PUT)
curl -X PUT http://localhost/api.php/lugares \
     -H "Content-Type: application/json" \
     -d '{
           "id": 1,
           "nombre": "Atenas",
           "descripcion": "Ciudad protegida por la diosa Atenea."
         }'

# Eliminar un lugar (DELETE)
curl -X DELETE http://localhost/api.php/lugares?id=1


# **Objetos**
# Obtener todos los objetos (GET)
curl -X GET http://localhost/api.php/objetos

# Crear un nuevo objeto (POST)
curl -X POST http://localhost/api.php/objetos \
     -H "Content-Type: application/json" \
     -d '{
           "nombre": "Tridente de Poseidón",
           "descripcion": "Arma poderosa del dios Poseidón.",
           "poder": "Controla los mares y océanos."
         }'

# Actualizar un objeto existente (PUT)
curl -X PUT http://localhost/api.php/objetos \
     -H "Content-Type: application/json" \
     -d '{
           "id": 1,
           "nombre": "Casco de Hades",
           "descripcion": "Casco que otorga invisibilidad.",
           "poder": "Permite al usuario volverse invisible."
         }'

# Eliminar un objeto (DELETE)
curl -X DELETE http://localhost/api.php/objetos?id=1


# **Préstamos**
# Obtener todos los préstamos (GET)
curl -X GET http://localhost/api.php/prestamos

# Crear un nuevo préstamo (POST)
curl -X POST http://localhost/api.php/prestamos \
     -H "Content-Type: application/json" \
     -d '{
           "libro_id": 1,
           "usuario_id": 2,
           "fecha_prestamo": "2023-10-10",
           "fecha_devolucion": "2023-10-17"
         }'

# Actualizar un préstamo existente (PUT)
curl -X PUT http://localhost/api.php/prestamos \
     -H "Content-Type: application/json" \
     -d '{
           "id": 1,
           "libro_id": 1,
           "usuario_id": 2,
           "fecha_prestamo": "2023-10-15",
           "fecha_devolucion": "2023-10-22"
         }'

# Eliminar un préstamo (DELETE)
curl -X DELETE http://localhost/api.php/prestamos?id=1


# **Reservas**
# Obtener todas las reservas (GET)
curl -X GET http://localhost/api.php/reservas

# Crear una nueva reserva (POST)
curl -X POST http://localhost/api.php/reservas \
     -H "Content-Type: application/json" \
     -d '{
           "libro_id": 1,
           "usuario_id": 2,
           "fecha_reserva": "2023-10-12"
         }'

# Actualizar una reserva existente (PUT)
curl -X PUT http://localhost/api.php/reservas \
     -H "Content-Type: application/json" \
     -d '{
           "id": 1,
           "libro_id": 1,
           "usuario_id": 2,
           "fecha_reserva": "2023-10-14"
         }'

# Eliminar una reserva (DELETE)
curl -X DELETE http://localhost/api.php/reservas?id=1
