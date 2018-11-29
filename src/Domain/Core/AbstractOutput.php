<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 23:50
 */

namespace App\Domain\Core;


abstract class AbstractOutput
{
    const CODE_OK = 200;
    const CODE_CREATED = 201;
    const CODE_ACCEPTED = 202;
    const CODE_EMPTY = 204;
    const CODE_BAD_REQUEST = 400;
    const CODE_UNAUTHORIZED = 401;
    const CODE_FORBIDDEN = 403;
    const CODE_NOT_FOUND= 404;
    const CODE_UNPROCESSABLE = 422;
    const CODE_FAILED_DEPENDENCY = 424;
    const CODE_SYSTEM = 500;
}