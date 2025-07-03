# Prueba Técnica - Alan Altamirano Hernández

## Ejecución del proyecto
1. Clonar el repositorio
2. Generar key de aplicación:  php artisan key:generate
2. Instalar dependencias de PHP (Sectum): composer install
3. Configurar archivo de variables de entorno: 
APP_TIMEZONE=America/Mexico_City y Variables de base de datos
3. Ejecutar migraciones

## Consideraciones antes de usar la API
1. En cada enpoint se debe agregar los headers de "Accept" y "Content-Type" con valor "application/json", debido a que se uso el archivo api.php para evitar conflicto en las peticiones con respecto al token de seguridad CSRF
2. Las peticiones de edicion y eliminiacion de usuario, hacen uso del token generado

## Endpoints de API
| Método | Endpoint                 | Descripción                                      |
|--------|--------------------------|--------------------------------------------------|
| POST   | /api/usuario/save        | Creación de usuario                              |
| POST   | /api/token               | Autenticación y generación de token de seguridad |
| PUT    | /api/usuario/update/{id} | Actualización de datos de usuario                |
| DELETE | /api/usuario/delete/{id} | Eliminación de usuario                           |

## Prueba de Endpoints en Postman
https://web.postman.co/workspace/My-Workspace~34882cdf-2bf2-4c9e-81cc-73a8970bf2b6/collection/36549654-1558d95b-978c-46af-a048-85bd57508c26?action=share&source=copy-link&creator=36549654
