
# Cloe API

Es un desarrollo para la facultad de ciencias y tecnología de la universidad de Carabobo. Dicho sistema pretende llevar el control de todos los RAEEs que ingresen a un centro de acopio dentro del nivel nacional.

En la presente documentación se especificarán los detalles de instalacion y uso de esta API.
## Tecnologías usadas

![Logo](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Logo](https://img.shields.io/badge/Swagger-85EA2D?style=for-the-badge&logo=Swagger&logoColor=white)
![Logo](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Logo](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Logo](https://img.shields.io/badge/GitLab-330F63?style=for-the-badge&logo=gitlab&logoColor=white)


## Instalación

1- Clonar este repositorio e ir a la carpeta

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

5- Aplicar migraciones y seeders
```bash
  php artisan migrate --seed
```

6- Poner en marcha el servidor
```bash
  php artisan serve
```
## API Reference

#### Obtener todos los centros de acopio

```http
  GET /api/items
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |

#### Get item

```http
  GET /api/items/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

#### add(num1, num2)

Takes two numbers and returns the sum.

