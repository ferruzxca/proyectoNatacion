-- Crear base de datos
CREATE DATABASE IF NOT EXISTS natacion_db;
USE natacion_db;

-- Tabla de usuarios del sistema
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    usuario VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    nivel ENUM('Administrador','Vendedor','Cliente') NOT NULL,
    estado TINYINT DEFAULT 1
);

-- Registros de prueba
INSERT INTO usuarios (nombre, usuario, password, nivel, estado) VALUES
('Raúl Ferruzca', 'admin', SHA2('admin123', 256), 'Administrador', 1),
('Juan Pérez', 'vendedor1', SHA2('vende123', 256), 'Vendedor', 1),
('María López', 'cliente1', SHA2('cliente123', 256), 'Cliente', 1);

-- Tabla de usuarios inscritos en natación
CREATE TABLE IF NOT EXISTS usuarios_natacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    edad INT,
    nivel ENUM('Básico','Intermedio','Avanzado'),
    fecha_inscripcion DATE
);

INSERT INTO usuarios_natacion (nombre, edad, nivel, fecha_inscripcion) VALUES
('Carlos Rodríguez', 10, 'Básico', '2024-03-01'),
('Andrea Ramírez', 14, 'Intermedio', '2024-03-05'),
('Luis Méndez', 18, 'Avanzado', '2024-03-10');

-- Tabla de horarios
CREATE TABLE IF NOT EXISTS horarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dia VARCHAR(20),
    hora_inicio TIME,
    hora_fin TIME,
    actividad VARCHAR(100)
);

INSERT INTO horarios (dia, hora_inicio, hora_fin, actividad) VALUES
('Lunes', '08:00:00', '09:00:00', 'Natación básica'),
('Martes', '10:00:00', '11:00:00', 'Rehabilitación física'),
('Miércoles', '09:00:00', '10:00:00', 'Competencia Juvenil');

-- Tabla de promociones
CREATE TABLE IF NOT EXISTS promociones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    descripcion TEXT,
    fecha_inicio DATE,
    fecha_fin DATE
);

INSERT INTO promociones (titulo, descripcion, fecha_inicio, fecha_fin) VALUES
('Descuento Primavera', '20% de descuento en inscripción.', '2024-04-01', '2024-04-30'),
('Mes del Niño', 'Primera clase gratis para menores de 12 años.', '2024-04-15', '2024-05-15'),
('Combo Familiar', 'Inscripción para 3 con precio especial.', '2024-05-01', '2024-05-31');

-- Tabla del reglamento
CREATE TABLE IF NOT EXISTS reglamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    regla TEXT
);

INSERT INTO reglamento (regla) VALUES
('Respetar los horarios asignados.'),
('Uso obligatorio de gorra y sandalias.'),
('Prohibido correr en el área de alberca.');

-- Tabla de instalaciones
CREATE TABLE IF NOT EXISTS instalaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT,
    imagen VARCHAR(100)
);

INSERT INTO instalaciones (nombre, descripcion, imagen) VALUES
('Alberca Olímpica', 'Piscina profesional de 50 metros con calefacción.', 'alberca.jpg'),
('Gimnasio Acuático', 'Área equipada con maquinaria de entrenamiento acuático.', 'gimnasio.jpg'),
('Área de Rehabilitación', 'Zona especializada para fisioterapia en el agua.', 'rehabilitacion.jpg');

-- Tabla de competencias
CREATE TABLE IF NOT EXISTS competencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    fecha DATE,
    descripcion TEXT
);

INSERT INTO competencias (nombre, fecha, descripcion) VALUES
('Torneo Infantil', '2024-05-12', 'Competencia de estilo libre para menores de 12 años.'),
('Carrera Juvenil', '2024-06-01', 'Estilo mariposa y pecho.'),
('Copa Interna', '2024-07-10', 'Evento anual entre alumnos del centro.');

-- Tabla de rehabilitación
CREATE TABLE IF NOT EXISTS rehabilitacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_nombre VARCHAR(100),
    fecha DATE,
    tipo_terapia VARCHAR(100),
    observaciones TEXT
);

INSERT INTO rehabilitacion (paciente_nombre, fecha, tipo_terapia, observaciones) VALUES
('Ana Torres', '2024-03-20', 'Hidroterapia de rodilla', 'Recuperación postoperatoria.'),
('Pedro Morales', '2024-03-22', 'Hidroterapia de espalda', 'Mejora en movilidad.'),
('Lucía Díaz', '2024-03-25', 'Rehabilitación articular', 'Dolor leve controlado.');

-- Tabla para gráficas mensuales
CREATE TABLE IF NOT EXISTS graficas_mensuales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mes VARCHAR(20),
    inscritos INT,
    rehabilitaciones INT,
    competencias INT
);

INSERT INTO graficas_mensuales (mes, inscritos, rehabilitaciones, competencias) VALUES
('Enero', 15, 5, 1),
('Febrero', 22, 6, 0),
('Marzo', 30, 7, 2);

CREATE TABLE IF NOT EXISTS visitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    fecha_registro DATETIME NOT NULL
);

INSERT INTO visitas (nombre, correo, fecha_registro) VALUES
('Pedro Morales', 'pedro@gmail.com', NOW()),
('Sandra Díaz', 'sandra@aol.com', NOW()),
('Luis Vega', 'luis@msn.com', NOW()),
('Valeria Núñez', 'valeria@outlook.com', NOW()),
('Mario Torres', 'mario@yahoo.com', NOW());

CREATE TABLE IF NOT EXISTS requisitos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion TEXT
);

INSERT INTO requisitos (descripcion) VALUES
('Presentar certificado médico reciente.'),
('Firmar carta responsiva al inscribirse.'),
('Tener mínimo 6 años de edad para clases grupales.'),
('Realizar pago de inscripción antes de iniciar.'),
('Llevar traje de baño, sandalias y gorra obligatoriamente.');
