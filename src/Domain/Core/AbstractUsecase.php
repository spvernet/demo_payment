<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 19:51
 */

namespace App\Domain\Core;


abstract  class AbstractUsecase
{
    abstract public function execute();
}