# Sistema de Gestión de Recursos Humanos (RRHH)

Proyecto desarrollado en PHP siguiendo el patrón MVC para la administración de colaboradores y perfiles laborales.

## Características

- Registro de colaboradores.
- Registro de perfiles laborales.
- Gestión de ocupaciones.
- Gestión de planillas.
- Validación de formularios.
- Sanitización de datos.
- Firma digital mediante OpenSSL.
- Reporte general de colaboradores.
- Exportación del reporte a Excel.
- Base de datos MySQL.

## Tecnologías

- PHP 8+
- MySQL
- HTML5
- CSS3
- OpenSSL
- Arquitectura MVC

## Estructura

```
controllers/
models/
views/
config/
classes/
public/
```

## Instalación

1. Clonar el repositorio.

```
git clone https://github.com/AntonioCastillo507/RRHH1.git
```

2. Copiar el proyecto dentro de:

```
C:\wamp64\www\
```

3. Iniciar Apache y MySQL desde WampServer.

4. Crear la base de datos.

5. Ejecutar el archivo `setup.php` para generar la estructura del proyecto y la base de datos.

6. Abrir en el navegador:

```
http://localhost/parcial3
```

## Funcionalidades

- Registrar colaboradores.
- Asignar perfiles laborales.
- Registrar bajas laborales.
- Validar integridad mediante firma digital.
- Consultar reportes.
- Exportar reportes a Excel.

## Autor

Antonio Castillo

GitHub:
https://github.com/AntonioCastillo507
