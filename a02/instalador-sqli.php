<?php







// Ruta al archivo de la base de datos SQLite
$databaseFile = 'taskdb.sqlite';

if (file_exists($databaseFile)) {
  echo "Base de datos SQLite ya existe.\n";
  exit(1);
}

try {
  // Conexión a la base de datos SQLite
  $conn = new PDO('sqlite:' . $databaseFile);
  // Establecer el modo de error PDO a excepción
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Crear la tabla 'tasks'
  $conn->exec("CREATE TABLE tasks (
        task_id INTEGER PRIMARY KEY AUTOINCREMENT,
        task_name VARCHAR(255) NOT NULL,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status TEXT DEFAULT 'pending',
        expiration_date DATE,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id_user)
    )");
  echo "Tabla 'tasks' creada con éxito.\n";

  // Crear la tabla 'users'
  $conn->exec("CREATE TABLE users (
        id_user INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR(255) NOT NULL,
        surname1 VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        enable BOOLEAN DEFAULT true
    )");
  echo "Tabla 'users' creada con éxito.\n";

  // Encriptar la contraseña
  $password = password_hash('adminadmin', PASSWORD_DEFAULT);

  // Insertar usuario admin con contraseña encriptada
  $stmt = $conn->prepare("INSERT INTO users (name, surname1, email, password, enable) VALUES ('admin', '', '', :password, 1)");
  $stmt->bindParam(':password', $password);
  $stmt->execute();
  echo "Usuario 'admin' creada con éxito\n";
} catch (PDOException $e) {
  echo "Error al ejecutar las consultas SQL: " . $e->getMessage();
}
