
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
Usuario Encargado:

  'email': encargado@cloe.com
  'username': encargado
  'password':  password
```

```bash
Usuario Clasificador:

  'email': clasificador@cloe.com
  'username': clasificador
  'password':  password
```

```bash
Usuario Separador:

  'email': separador@cloe.com
  'username': separador
  'password':  password
```


## Ruta de documentación (Swagger)
```bash
  http://cloebe.test/api/documentation

  or

  http://localhost:8000/api/documentation
```


## [API - Auth] login

```http
  POST /api/auth/login
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email_username` | `string` | **Required**. Tu usuario o email |
| `password` | `string` | **Required**. Tu contraseña |

## [API - Auth] logout

```http
  POST /api/auth/logout
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

## [API - Auth] forgot password

```http
  POST /api/auth/forgot-password
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required**. |

## [API - Auth] reset password

```http
  POST /api/auth/reset-password
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `password`      | `string` | **Required**. |
| `confirm_password`      | `string` | **Required**. |
| `Authorization`      | `string` | **Required in headers**. |

## [API - Landing] Formulario de contacto

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

## [API - Landing] Consultar estados

```http
  GET /api/utils/estados
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| --      | -- | **nothings**. |

## [API - Landing] Consultar ciudades

```http
  GET /api/utils/ciudades
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `filters`      | `array` | **Optional**. |
| `filters.estado_id`      | `numeric` | **Required if filters**. |

## [API - Landing] Consultar centros de acopio

```http
  GET /api/utils/centros
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `filters`      | `array` | **Optional**. |
| `filters.estado_id`      | `numeric` | **Required if filters**. |
| `filters.ciudad_id`      | `numeric` | **Required if filters**. |

## [API - Admin] index centros de acopio

```http
  GET /api/centro-acopio/index
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `filters`      | `array` | **Optional**. |
| `filters.estado_id`      | `numeric` | **Required if filters**. |
| `filters.ciudad_id`      | `numeric` | **Required if filters**. |

## [API - Admin] show centros de acopio

```http
  GET /api/centro-acopio/show/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

## [API - Admin] store centros de acopio

```http
  POST /api/centro-acopio/store
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `encargado_id`      | `numeric` | **Required**. |
| `estado_id`      | `numeric` | **Required**. |
| `municipio_id`      | `numeric` | **Required**. |
| `description`      | `string` | **Optional**. |
| `address`      | `string` | **Required**. |

## [API - Admin] update centros de acopio

```http
  PUT /api/centro-acopio/update/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `encargado_id`      | `numeric` | **Required**. |
| `estado_id`      | `numeric` | **Required**. |
| `municipio_id`      | `numeric` | **Required**. |
| `description`      | `string` | **Optional**. |
| `address`      | `string` | **Required**. |

## [API - Admin] activar un centro de acopio

```http
  POST /api/centro-acopio/activate/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

## [API - Admin] desactivar un centro de acopio

```http
  POST /api/centro-acopio/desactivate/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

## [API - Admin] index users

```http
  GET /api/users/index
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

## [API - Admin] show users

```http
  GET /api/users/show/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

## [API - Admin] store users

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
| `estado_id`      | `integer` | **Required**. |
| `municipio_id`      | `integer` | **Required**. |
| `centro_id`      | `integer` | **Optional**. |

## [API - Admin] update users

```http
  PUT /api/users/update/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `name`      | `string` | **Required**. |
| `lastname`      | `string` | **Required**. |
| `email`      | `string` | **Required**. |
| `address`      | `string` | **Required**. |
| `ci_type`      | `string` | **Required**. tipos: [V,E,P,J,G] |
| `ci_number`      | `string` | **Required**. |
| `estado_id`      | `integer` | **Required**. |
| `municipio_id`      | `integer` | **Required**. |
| `centro_id`      | `integer` | **Optional**. |

## [API - Admin] activar un usuario

```http
  POST /api/users/activate/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `role`      | `string` | **Required**. |

## [API - Admin] desactivar un usuario

```http
  POST /api/users/desactivate/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

## [API - Admin] listar usuarios dado un rol

```http
  GET /api/users/getByRoleName
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `roleName`      | `string` | **Required**. |
| `estado_id`      | `integer` | **Required**. |

## [API - Admin] delete users

```http
  DELETE /api/users/delete/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

## [API - Admin] store RAEES

```http
  POST /api/raee/store
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `line_id`      | `integer` | **Required**. |
| `category_id`      | `integer` | **Required**. |
| `brand_id`      | `integer` | **Required**. |
| `model`      | `string` | **Required**. |
| `information`      | `string` | **Optional**. |

## [API - Admin] update RAEES

```http
  PUT /api/raee/update/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `line_id`      | `integer` | **Required**. |
| `category_id`      | `integer` | **Required**. |
| `brand_id`      | `integer` | **Required**. |
| `model`      | `string` | **Required**. |
| `information`      | `string` | **Optional**. |

## [API - Admin] show RAEES

```http
  GET /api/raee/show/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |

## [API - Admin] index RAEES

```http
  GET /api/raee/index
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |
| `filters`      | `array` | **Optional**. |
| `filters.status`      | `string` | **Required if filters**. |

## [API - Admin] delete RAEES

```http
  DELETE /api/raee/delete/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Tu API token |



## Authors

- [@gisuss](https://gitlab.com/gisuss)
- [@jhonattanrgc21](#)