
# Cloe API

Es un desarrollo para la facultad de ciencias y tecnología de la universidad de Carabobo. Dicho sistema pretende llevar el control de todos los RAEEs que ingresen a un centro de acopio dentro del territorio a nivel nacional.

En la presente documentación se especificarán los detalles de instalacion y uso de esta API.
## Tecnologías usadas

![Logo](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Logo](https://img.shields.io/badge/Swagger-85EA2D?style=for-the-badge&logo=Swagger&logoColor=white)
![Logo](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Logo](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Logo](https://img.shields.io/badge/GitLab-330F63?style=for-the-badge&logo=gitlab&logoColor=white)


## Instalación

1- Clonar este repositorio e ir a la carpeta raiz

2- instalar/actualizar dependencias de composer
```bash
  composer install
  composer update
```
3- Generar archivo .env
```bash
  cp .env-example .env
```

4- Generar api key de laravel
```bash
  php artisan key:generate
```

5- Crear y configurar la DB en el .env

6- Aplicar migraciones y seeders
```bash
  php artisan migrate --seed
```

7- Generar json de Swagger
```bash
  php artisan l5-swagger:generate
```

8- Poner en marcha el servidor
```bash
  php artisan serve
```

9- En caso de usar Valet:

9.1- Desde la terminal, ubicarse en la carpeta contenedora de tus proyectos

9.2- ejecutar el comando
```bash
  valet park
```

9.3- Desde la terminal, ubicarse en la raiz del proyecto laravel
```bash
  valet link
```

9.4- para verificar tu enlace simbólico al proyecto
```bash
  valet links
```

## Usuarios de Prueba
```bash
Usuario Administrador:

  'email': admin@cloe.com
  'username': admin
  'password':  password
```

```bash
Usuario Recolector:

  'email': recolector@cloe.com
  'username': recolector
  'password':  password
```

```bash
Usuario Separador:

  'email': separador@cloe.com
  'username': separador
  'password':  password
```

## API Reference

#### Inicio de Sessión

```http
  POST /api/auth/login
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email_username` | `string` | **Required**. Tu usuario o email |
| `password` | `string` | **Required**. Tu contraseña |

#### Logout

```http
  POST /api/auth/logout
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

#### Solicitud de cambio de contraseña

```http
  POST /api/auth/forgot-password
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required**. |

#### Cambio de contraseña

```http
  POST /api/auth/reset-password
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `password`      | `string` | **Required**. |
| `confirm_password`      | `string` | **Required**. |
| `pin`      | `string` | **Required**. Pin recibido por email |

#### Formulario de contacto desde landing page (NO AUTH)

```http
  POST /api/utils/contact
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**. |
| `phone`      | `string` | **Required**. |
| `email`      | `string` | **Required**. |
| `city`      | `string` | **Required**. |
| `message`      | `string` | **Required**. |

#### Consultar estados desde landing page (NO AUTH)

```http
  GET /api/utils/estados
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| ``      | `` | **nothings**. |

#### Consultar ciudades desde landing page (NO AUTH)

```http
  GET /api/utils/ciudades
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `filters`      | `array` | **Optional**. |
| `filters.estado_id`      | `numeric` | **Required if filters**. |

#### Consultar centros de acopio desde landing page (NO AUTH)

```http
  GET /api/utils/centros
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `filters`      | `array` | **Optional**. |
| `filters.estado_id`      | `numeric` | **Required if filters**. |
| `filters.ciudad_id`      | `numeric` | **Required if filters**. |

#### Listar todos los centros de acopio

```http
  GET /api/centro-acopio/index
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `filters`      | `array` | **Optional**. |
| `filters.estado_id`      | `numeric` | **Required if filters**. |
| `filters.ciudad_id`      | `numeric` | **Required if filters**. |

#### Muestra la información de un centro de acopio

```http
  GET /api/centro-acopio/show/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

#### Registra un nuevo centro de acopio

```http
  POST /api/centro-acopio/store
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `encargado_id`      | `numeric` | **Required**. |
| `estado_id`      | `numeric` | **Required**. |
| `ciudad_id`      | `numeric` | **Required**. |
| `description`      | `string` | **Optional**. |
| `address`      | `string` | **Required**. |

#### Actualiza la información de un centro de acopio

```http
  PUT /api/centro-acopio/update/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `encargado_id`      | `numeric` | **Required**. |
| `estado_id`      | `numeric` | **Required**. |
| `ciudad_id`      | `numeric` | **Required**. |
| `description`      | `string` | **Optional**. |
| `address`      | `string` | **Required**. |

#### Activa un centro de acopio

```http
  POST /api/centro-acopio/activate/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

#### Desactiva un centro de acopio

```http
  POST /api/centro-acopio/desactivate/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

#### Listar todos los usuarios

```http
  GET /api/users/index
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

#### Muestra la información de un usuario

```http
  GET /api/users/show/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

#### Registra un nuevo usuario

```http
  POST /api/users/register
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `name`      | `string` | **Required**. |
| `lastname`      | `string` | **Required**. |
| `email`      | `string` | **Required**. |
| `address`      | `string` | **Required**. |
| `role`      | `string` | **Required**. |
| `ci_type`      | `string` | **Required**. tipos: [V,E,P,J,G] |
| `ci_number`      | `string` | **Required**. |

#### Actualiza la información de un usuario

```http
  PUT /api/users/update
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `name`      | `string` | **Required**. |
| `lastname`      | `string` | **Required**. |
| `email`      | `string` | **Required**. |
| `address`      | `string` | **Required**. |
| `role`      | `string` | **Required**. |
| `ci_type`      | `string` | **Required**. tipos: [V,E,P,J,G] |
| `ci_number`      | `string` | **Required**. |

#### Activa a un usuario

```http
  POST /api/users/activate/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `role`      | `string` | **Required**. |

#### Desactiva a un usuario

```http
  POST /api/users/desactivate/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

#### Listar usuarios dado un rol

```http
  POST /api/users/getByRoleName
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `roleName`      | `string` | **Required**. |

## Authors

- [@gisuss](https://gitlab.com/gisuss)
- [@jhonattanrgc21](#)