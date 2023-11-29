<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Cloe API Documentation",
 *      description="Cloe API documentation",
 *      @OA\Contact(
 *          name="Jesus Romero",
 *          email="gisuss8520@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 * @OA\Schemes(format="http")
 * @OA\SecurityScheme(
 *      securityScheme="sanctum",
 *      in="header",
 *      name="sanctum",
 *      type="http",
 *      scheme="bearer",
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
