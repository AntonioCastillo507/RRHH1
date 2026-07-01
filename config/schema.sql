CREATE TABLE IF NOT EXISTS cat_tipos_planilla (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS cat_ocupaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(80) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS colaborador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    identidad VARCHAR(20) NOT NULL UNIQUE,
    nombre VARCHAR(80) NOT NULL,
    apellido VARCHAR(80) NOT NULL,
    edad INT NOT NULL,
    tipo_sangre VARCHAR(5) NOT NULL,
    sexo ENUM('M','F') NOT NULL,
    nacionalidad VARCHAR(50) NOT NULL,
    ruta ENUM('Este','Oeste','Norte') NOT NULL,
    correo VARCHAR(120) NOT NULL UNIQUE,
    celular VARCHAR(20) NOT NULL,
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS perfil_laboral (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_empleado INT NOT NULL,
    ocupacion_id INT NOT NULL,
    planilla_id INT NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    tipo_empleado VARCHAR(30) NOT NULL,
    cargo_activo TINYINT(1) NOT NULL DEFAULT 1,
    empleado_activo TINYINT(1) NOT NULL DEFAULT 1,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NULL,
    es_activo TINYINT(1) NOT NULL DEFAULT 1,
    motivo_baja VARCHAR(255) NULL,
    firma TEXT NULL,
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_perfil_colaborador FOREIGN KEY (codigo_empleado) REFERENCES colaborador(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_perfil_ocupacion FOREIGN KEY (ocupacion_id) REFERENCES cat_ocupaciones(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_perfil_planilla FOREIGN KEY (planilla_id) REFERENCES cat_tipos_planilla(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO cat_tipos_planilla (nombre) SELECT * FROM (SELECT 'Permanente') t WHERE NOT EXISTS (SELECT 1 FROM cat_tipos_planilla WHERE nombre='Permanente') LIMIT 1;
INSERT INTO cat_tipos_planilla (nombre) SELECT * FROM (SELECT 'Eventual') t WHERE NOT EXISTS (SELECT 1 FROM cat_tipos_planilla WHERE nombre='Eventual') LIMIT 1;
INSERT INTO cat_tipos_planilla (nombre) SELECT * FROM (SELECT 'Interino') t WHERE NOT EXISTS (SELECT 1 FROM cat_tipos_planilla WHERE nombre='Interino') LIMIT 1;

INSERT INTO cat_ocupaciones (nombre) SELECT * FROM (SELECT 'Secretaria') t WHERE NOT EXISTS (SELECT 1 FROM cat_ocupaciones WHERE nombre='Secretaria') LIMIT 1;
INSERT INTO cat_ocupaciones (nombre) SELECT * FROM (SELECT 'Albañil') t WHERE NOT EXISTS (SELECT 1 FROM cat_ocupaciones WHERE nombre='Albañil') LIMIT 1;
INSERT INTO cat_ocupaciones (nombre) SELECT * FROM (SELECT 'Ingeniero') t WHERE NOT EXISTS (SELECT 1 FROM cat_ocupaciones WHERE nombre='Ingeniero') LIMIT 1;
